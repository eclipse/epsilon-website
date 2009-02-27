<font color='#3F7F5F'>--&nbsp;Create&nbsp;a&nbsp;new&nbsp;EPackage</font><br>
<b><font color='#7F0055'>var</font></b>&nbsp;ePackage&nbsp;:=&nbsp;<b><font color='#7F0055'>new</font></b>&nbsp;EPackage;<br>
ePackage.name&nbsp;:=&nbsp;<font color='#2A00FF'>'randomlang'</font>;<br>
<br>
<font color='#3F7F5F'>--&nbsp;Create&nbsp;10&nbsp;EClasses&nbsp;in&nbsp;the&nbsp;ePackage</font><br>
<b><font color='#7F0055'>for</font></b>&nbsp;(i&nbsp;<b><font color='#7F0055'>in</font></b>&nbsp;<b><font color='#00C000'>Sequence</font></b>{1..10})&nbsp;{<br>
&nbsp;&nbsp;<b><font color='#7F0055'>var</font></b>&nbsp;eClass&nbsp;:=&nbsp;<b><font color='#7F0055'>new</font></b>&nbsp;EClass;<br>
&nbsp;&nbsp;eClass.name&nbsp;:=&nbsp;<font color='#2A00FF'>'Classs'</font>&nbsp;+&nbsp;i;<br>
&nbsp;&nbsp;ePackage.eClassifiers.add(eClass);<br>
}<br>
<br>
<font color='#3F7F5F'>--&nbsp;Assign&nbsp;each&nbsp;EClass&nbsp;a&nbsp;random&nbsp;super&nbsp;type</font><br>
<b><font color='#7F0055'>for</font></b>&nbsp;(eClass&nbsp;<b><font color='#7F0055'>in</font></b>&nbsp;EClass.all)&nbsp;{<br>
&nbsp;&nbsp;<b><font color='#7F0055'>var</font></b>&nbsp;supertype&nbsp;:=&nbsp;EClass.all.excluding(eClass).random();<br>
&nbsp;&nbsp;eClass.eSuperTypes.add(supertype);<br>
}<br>
<br>
<font color='#3F7F5F'>--&nbsp;Query&nbsp;the&nbsp;model&nbsp;and&nbsp;print&nbsp;the&nbsp;subtypes&nbsp;of&nbsp;each&nbsp;EClass</font><br>
<b><font color='#7F0055'>for</font></b>&nbsp;(eClass&nbsp;<b><font color='#7F0055'>in</font></b>&nbsp;EClass.all)&nbsp;{<br>
&nbsp;&nbsp;<b><font color='#7F0055'>var</font></b>&nbsp;subtypes&nbsp;:=&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;EClass.all.select(c|c.eSuperTypes.includes(eClass));<br>
&nbsp;&nbsp;<b><font color='#7F0055'>var</font></b>&nbsp;message&nbsp;:=&nbsp;<font color='#2A00FF'>'Class&nbsp;'</font>&nbsp;+&nbsp;eClass.name&nbsp;+&nbsp;<font color='#2A00FF'>'&nbsp;is&nbsp;extended&nbsp;by&nbsp;'</font>;<br>
&nbsp;&nbsp;message&nbsp;:=&nbsp;message&nbsp;+&nbsp;<br>
&nbsp;&nbsp;&nbsp;&nbsp;subtypes.collect(c|c.name).concat(<font color='#2A00FF'>','</font>);<br>
&nbsp;&nbsp;message.println();<br>
}