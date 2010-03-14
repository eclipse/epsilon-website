<?
class WikiTextToHTML {
	/**
	 * Wiki text to HTML script.
	 * (c) 2007, Frank Schoep
	 *
	 * This script will convert the input given on the standard input
	 * from Wiki style text syntax to minimally formatted HTML output.
	 */

	// these constants define the list states
	const LS_NONE		=	0;
	const LS_ORDERED	=	1;
	const LS_UNORDERED	=	2;

	// definitions for the list open and close tags
	private static $LT_OPEN =
		array(
			LS_ORDERED	=>	"<ol>",
			LS_UNORDERED	=>	"<ul>"
		);

	private static $LT_CLOSE =
		array(
			LS_ORDERED	=>	"</ol>",
			LS_UNORDERED	=>	"</ul>"
		);
		
	// constants for defining preformatted code state
	const CS_NONE		=	0;
	const CS_CODE		=	1;

	/*
	 * These rules contain the conversion from Wiki text to HTML
	 * described as regular expressions. The first part matches
	 * source text, the second part rewrites it as HTML.
	 */	 
	private static $RULES =
		array(
			'/^======(.*)======$/'
				=> '<h6>\1</h6>',
			'/^=====(.*)=====$/'
				=>	'<h5>\1</h5>',
			'/^====(.*)====$/'
				=>	'<h4>\1</h4>',
			'/^===(.*)===$/'
				=>	'<h3>\1</h3>',
			'/^==(.*)==$/'
				=>	'<h2>\1</h2>',
			'/^=(.*)=$/'
				=>	'<h1>\1</h1>',
			//'/\[\[(.*?)\]\]/'
			//	=>	'<span class="keys">\1</span>',
			'/^([ ]*)\# (.+)$/'
				=>	'<li>\2</li>',
			'/^([ ]*)\* (.+)$/'
				=>	'<li>\2</li>',
			'/\*(.+?)\*/'
				=>	'<em>\1</em>',
			"/'''(.+?)'''/"
				=>	'<b>\1</b>',
			"/''(.+?)''/"
				=>	'<i>\1</i>',
			'/`(.+?)`/'
				=>	'<tt>\1</tt>',
			'/\[\[imageimage:(.+?)\|(.+?)\]\]/'
				=>	'<img src="\1" alt="\2"/>',
			'/\[\[image:(.+?)\]\]/'
				=>	'<img src="\1"/>',
			'/\[\[(.+?)\|(.+?)\]\]/'
				=>	'<a href="\1">\2</a>',
			'/\[\[(.+?)\]\]/'
				=>	'<a href="\1">\1</a>',
			'/^----$/'
				=>	'<hr />',
			'/_backticks/'
				=>	'` `'
		);
	
	
	public static function convertWikiTextToToc($input) {
		$input = explode("\n", $input);
		
		$output = "";
		$codestate = CS_NONE;
		$headingLevel = 0;
		
		// loop through the input
		foreach($input as $in) {
			
			if ($in == "{{{") {
				$codestate = CS_CODE;
			}
			else if ($in == "}}}") {
				$codestate = CS_NONE;
				continue;
			}
			
			if ($codestate = CS_NONE) {
				
				$newHeadingLevel = WikiTextToHTML::getHeadingLevel($in);
				
				if ($newHeadingLevel > 0) {
				
					if ($newHeadingLevel > $headingLevel) {
						$headingLevel = $newHeadingLevel;
						$output .= "<ul>";
					}
					else if ($newHeadingLevel < $headingLevel) {
						$headingLevel = $newHeadingLevel;
						$output .= "</ul>";
					}
					
					$output .= "<li>".WikiTextToHTML::getHeadingText($in);
				
				}
			}
			
		}
		
		$output .= "</ul>";
		return $output;
	}
	
	public static function isHeading($line) {
		return getHeadingLevel($line) > -1;
	}
	
	public static function getHeadingText($line) {
		$heading = trim($line);
		$heading = preg_replace("/^=*/", "", $heading);
		$heading = preg_replace("/=*$/", "", $heading);
		return $heading;
	}
	
	public static function getHeadingLevel($line) {
		$line = trim($line);
		if (preg_match("/^=(.*)=$/", $line)) {
			$chars = str_split($line);
			$level = 0;
			foreach ($chars as $char) {
				if ($char == "=") {
					$level ++;
				}
				else {
					return $level;
				}
			}
		}
		return -1;
	}
	
	public static function convertWikiTextToHTML($input) {
	
		$lines = explode("\n", $input);
		$output = "";
		
		foreach ($lines as $line) {
		
			if (strpos($line,"[[file:") === 0) {
				$file = substr($line, 7, strlen($line)-9);
				$output = $output."{{{\n".file_get_contents($file)."\n}}}\n";
			}
			else if (strpos($line,"[[svn:") === 0) {
				$file = "http://dev.eclipse.org/svnroot/modeling/org.eclipse.gmt.epsilon/trunk/".substr($line, 6, strlen($line)-8);
				$output = $output."{{{\n".file_get_contents($file)."\n}}}\n";
			}
			else {
				$output = $output.$line."\n";
			}
		}
		
		return WikiTextToHTML::convertWikiTextToHTMLImpl($output);
	}
	
	/**
	 * Converts a Wiki text input string to HTML.
	 * 
	 * @param	array	$input	The array of strings containing Wiki
	 * 				text markup.
	 * @return	array	An array of strings containing the output
	 * 			in HTML.	
	 */
	public static function convertWikiTextToHTMLImpl($input) {
	
		$input = explode("\n", $input);
		
		// output array
		$output = array();

		// reset initial list states
		$liststate = LS_NONE;
		$listdepth = 1;
		$prevliststate = $liststate;
		$prevlistdepth = $listdepth;
		
		// preformatted code state
		$codestate = CS_NONE;

		// loop through the input
		foreach($input as $in) {
			
			// Ignore lines with just one space
			if ($in == " \r" || $in == " ") {
				continue;
 			}
			
			// read, htmlify and right-trim each input line
			$in = htmlspecialchars(rtrim($in));
			$out = $in;		
			$out = preg_replace("/\t/", "  ",$out);	
			
			if (CS_NONE == $codestate) {
				// match against Wiki text to HTML rules
				foreach(self::$RULES as $pattern => $replacement) {
					$out = preg_replace($pattern, $replacement,
						$out);
				}
			
						
				// determine list state based on leftmost character
				$prevliststate = $liststate;
				$prevlistdepth = $listdepth;
				switch(substr(ltrim($in), 0, 1)) {
					case '#':
						$liststate = LS_ORDERED;
						$listdepth = strpos($in, '1');
						break;
					case '*':
						$liststate = LS_UNORDERED;
						$listdepth = strpos($in, '*');
						break;
					default:
						$liststate = LS_NONE;
						$listdepth = 1;
						break;
				}
				
				// check if list state has changed
				if($liststate != $prevliststate) {
					// close old list
					if(LS_NONE != $prevliststate) {
						$output[] =
							self::$LT_CLOSE[$prevliststate];
					}
					
					// start new list
					if(LS_NONE != $liststate) {
						$output[] = self::$LT_OPEN[$liststate];
					}
				}
				
				// check if list depth has changed
				if ($listdepth != $prevlistdepth) {
					// calculate the depth difference
					$depthdiff = abs($listdepth - $prevlistdepth);

					// open or close tags based on difference
					if($listdepth > $prevlistdepth) {
						for($i = 0;
							$i < $depthdiff;
							$i++)
						{
							$output[] =
								self::$LT_OPEN[$liststate];
						}
					} else {
						for($i = 0;
							$i < $depthdiff;
							$i++)
						{
							$output[] =
								self::$LT_CLOSE[$prevliststate];
						}
					}
				}
			}
			
			// determine output format
			if('' == $in && CS_NONE == $codestate) {
				$output[] = '<br><br>';
			} else if ('{{{' == trim($in)) {
				$output[] = '<pre class="codebox">';
				$codestate = CS_CODE;
			} else if ('}}}' == trim($in)) {
				$output[] = '</pre>';
				$codestate = CS_NONE;
			} else if (
				$in[0] != '=' &&
				$in[0] != ' ' &&
				$in[0] != '-')
			{
				// only output paragraphs when not in code
				if(CS_NONE == $codestate) {
					//$output[] = '<p>';
				}

				$output[] = $out;

				// only output paragraphs when not in code
				if(CS_NONE == $codestate) {
					//$output[] = '</p>';
				}
			} else {
				$output[] = $out;
			}
		}
		
		$result = "";
		
		// output to stream with newlines
		foreach($output as $line) {
			$result.="${line}\n";
		}
		
		//$result = preg_replace("/___TOC___/", WikiTextToHTML::convertWikiTextToToc($input), $result);
		
		// return the output
		return $result;
	}

	/**
	 * Converts an input stream to HTML.
	 * 
	 * @param	stream	$input	The input stream containing lines
	 * 				of Wiki text markup.
	 * @return	array	An array of strings containing the output
	 * 			in HTML.
	 */
	public static function convertWikiTextStreamToHTML($stream) {
		// input buffer
		$input = array();
		
		// loop through the stream
		while(!feof($stream)) {
			$input[] = fgets($stream);
		}
		
		// convert Wiki text to HTML and return result
		return self::convertWikiTextToHTML($input);
	}
}
?>