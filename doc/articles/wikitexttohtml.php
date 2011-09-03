<?

class WikiTextToHTML {
	
	var $incode = false;
	
	var $rules =
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
			"/-&gt;/"
				=>	'&rarr;',
			"/&lt;-/"
				=>	'&larr;',
			'/`(.+?)`/'
				=>	'<tt>\1</tt>',
			'/\[\[image:(.+?)\|(.+?)\]\]/'
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
	

	public function convertWikiTextToToc($input) {
		$input = explode("\n", $input);
		
		$output = "";
		$headingLevel = 0;
		
		// loop through the input
		foreach($input as $in) {
			
			if ($in == "{{{") {
				$this->incode = true;
			}
			else if ($in == "}}}") {
				$this->incode = false;
				continue;
			}
			
			if ($this->incode) {
				
				$newHeadingLevel = $this->getHeadingLevel($in);
				
				if ($newHeadingLevel > 0) {
				
					if ($newHeadingLevel > $headingLevel) {
						$headingLevel = $newHeadingLevel;
						$output .= "<ul>";
					}
					else if ($newHeadingLevel < $headingLevel) {
						$headingLevel = $newHeadingLevel;
						$output .= "</ul>";
					}
					
					$output .= "<li>".$this->getHeadingText($in);
				
				}
			}
			
		}
		
		$output .= "</ul>";
		return $output;
	}
	
	public function isHeading($line) {
		return getHeadingLevel($line) > -1;
	}
	
	public function getHeadingText($line) {
		$heading = trim($line);
		$heading = preg_replace("/^=*/", "", $heading);
		$heading = preg_replace("/=*$/", "", $heading);
		return $heading;
	}
	
	
	public function getHeadingLevel($line) {
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
	
	public function convertWikiTextToHTML($input) {
	
		$lines = explode("\n", $input);
		$output = "";
		
		foreach ($lines as $line) {
		
			if (strpos($line,"[[file:") === 0) {
				$file = substr(trim($line), 7);
				$file = substr($file, 0, strlen($file) - 2);
				$output = $output."{{{\n".file_get_contents($file)."\n}}}\n";
			}
			else if (strpos($line,"[[svn:") === 0) {
				$s = substr(trim($line), 6);
				$s = substr($s, 0, strlen($s) - 2);
				$file = "http://dev.eclipse.org/svnroot/modeling/org.eclipse.gmt.epsilon/trunk/".$s;
				$output = $output."{{{\n".file_get_contents($file)."\n}}}\n";
			}
			else {
				$output = $output.$line."\n";
			}
		}
		
		return $this->convertWikiTextToHTMLImpl($output);
	}
	
	public function convertWikiTextToHTMLImpl($input) {
	
		$input = explode("\n", $input);
		
		// output array
		$output = array();
		
		// preformatted code state
		$this->incode = false;
		
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
			
			if (!$this->incode) {
				foreach($this->rules as $pattern => $replacement) {
					$out = preg_replace($pattern, $replacement,
						$out);
				}
			}
			
			
			// determine output format
			if('' == $in && (!$this->incode)) {
				$output[] = '<br><br>';
			} else if ('{{{' == trim($in)) {
				$output[] = '<pre class="codebox">';
				$this->incode = true;
			} else if ('}}}' == trim($in)) {
				$output[] = '</pre>';
				$this->incode = false;
			} else {
				$output[] = $out;
			}
		}
		
		$result = "";
		
		// output to stream with newlines
		foreach($output as $line) {
			$result.="${line}\n";
		}
		
		// return the output
		return $result;
	}

	public function convertWikiTextStreamToHTML($stream) {
		// input buffer
		$input = array();
		
		// loop through the stream
		while(!feof($stream)) {
			$input[] = fgets($stream);
		}
		
		// convert Wiki text to HTML and return result
		return $this->convertWikiTextToHTML($input);
	}
}
?>