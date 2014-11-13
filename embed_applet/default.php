<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<!-- #BeginTemplate "../master.dwt" -->

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<script language="javascript" type="text/javascript">

<!-- Begin
function popUp(URL,WIDTH,HEIGHT) {
day = new Date();
id = day.getTime();
//old code
// eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=WIDTH,height=HEIGHT');");
//eval("page" + id + " = window.open(URL, '" + id + "', "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=" + WIDTH",height=" + HEIGHT);");
// eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=' + WIDTH ',height=' + HEIGHT);");
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=' + WIDTH + ',height=' + HEIGHT);");

}
// End -->
</script>

<script type="text/javascript" src="../javascript/jquery.js"></script>
<script type="text/javascript" src="../javascript/jcarousellite_1.0.1.js"></script>
<script type="text/javascript">

/* CLOSED_IMAGE - the image to be displayed when the sublists are closed
 * OPEN_IMAGE   - the image to be displayed when the sublists are opened
 */
CLOSED_IMAGE='../images/plus.png';
OPEN_IMAGE='../images/minus.png';

/* makeCollapsible - makes a list have collapsible sublists
 * 
 * listElement - the element representing the list to make collapsible
 */
function makeCollapsible(listElement){

  // removed list item bullets and the sapce they occupy
  listElement.style.listStyle='none';
  listElement.style.marginLeft='0';
  listElement.style.paddingLeft='0';

  // loop over all child elements of the list
  var child=listElement.firstChild;
  while (child!=null){

    // only process li elements (and not text elements)
    if (child.nodeType==1){

      // build a list of child ol and ul elements and hide them
      var list=new Array();
      var grandchild=child.firstChild;
      while (grandchild!=null){
        if (grandchild.tagName=='OL' || grandchild.tagName=='UL'){
          grandchild.style.display='none';
          list.push(grandchild);
        }
        grandchild=grandchild.nextSibling;
      }

      // add toggle buttons
//    var node=document.createElement('img');
//    node.setAttribute('src',CLOSED_IMAGE);
//    node.setAttribute('class','collapsibleClosed');
//     node.onclick=createToggleFunction(node,list);
//     child.insertBefore(node,child.firstChild);
       var node=listElement;
   //    node.setAttribute('src',CLOSED_IMAGE);
      node.setAttribute('class','collapsibleClosed');
      node.onclick=createToggleFunction(node,list);
 //     child.insertBefore(node,child.firstChild);


    }

    child=child.nextSibling;
  }

}

/* createToggleFunction - returns a function that toggles the sublist display
 * 
 * toggleElement  - the element representing the toggle gadget
 * sublistElement - an array of elements representing the sublists that should
 *                  be opened or closed when the toggle gadget is clicked
 */
function createToggleFunction(toggleElement,sublistElements){

  return function(){

    // toggle status of toggle gadget
    if (toggleElement.getAttribute('class')=='collapsibleClosed'){
      toggleElement.setAttribute('class','collapsibleOpen');
  //    toggleElement.setAttribute('src',OPEN_IMAGE);
    }else{
      toggleElement.setAttribute('class','collapsibleClosed');
 //     toggleElement.setAttribute('src',CLOSED_IMAGE);
    }

    // toggle display of sublists
    for (var i=0;i<sublistElements.length;i++){
      sublistElements[i].style.display=
          (sublistElements[i].style.display=='block')?'none':'block';
    }

  }

}

</script>



<!-- #BeginEditable "doctitle" -->
<title>Data</title>

<style type="text/css">






































































.dataCategories {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 1.4em;
	font-weight: normal;
	font-style: normal;
	font-variant: normal;
	color: #000000;
}
</style>
<!-- #EndEditable -->

<!-- <link href="runnertest/include/style.css" rel="stylesheet" type="text/css" /> -->
<link href="../styles/style2.css" rel="stylesheet" type="text/css" />

</head>

<body onload="makeCollapsible(document.getElementById('collapse'));">

<!-- Begin Container -->
<div id="container">
	<!-- Begin Masthead -->
	<div id="masthead">
	</div>
	<!-- End Masthead -->
	<!-- Begin Navigation -->
	<div id="navigation">
		<ul>
			<li><a href="../index.html">Abstract</a></li>
			<li><a href="../runnertest/Project1/output">Relational Database</a></li>
			<li><ul>
			<li><a href="../data/default.html">Supplementary Datasets</a>
				<ul>
					<li><a href="../data/MicroArray.html">Transcriptome</a></li>
					<li><a href="../data/Methylome.html">Methylome</a></li>
					<li><a href="../data/ChIP-SeqHistone.html">Epigenome</a></li>
					<li><a href="../data/ChIP-Seq.html">Esrrb ChIP-Seq</a></li>
					<li><a href="../data/MicroRNA.html">miRNA Expression Profile</a></li>
					<li><a href="../data/Proteome.html">Nuclear Proteome</a></li>
					<li><a href="../data/integrated.html">Integrated Data</a></li>
				</ul>
			</li></ul></li>
			<li><ul>
				<li><a>Figures</a>
					<ul>
						<li><a href="../images_gallery/main_figures.html">Main Figures</a></li>
						<li>
						<a href="../images_gallery/supplementary_figures.html">Supplementary Figures</a></li>
					</ul>
				</li>
				</ul>
			</li>
			<li><a href="../movies/default.html">Movies</a></li>
			<li><a href="../tools/default.html">Tools</a></li>
			<li><a href="../laboratories/default.html">Laboratories</a></li>
		</ul>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	</div>
	<!-- End Navigation -->
	<!-- Begin Content -->
	<div id="content">
		<!-- #BeginEditable "content" -->
<?php
    include ('embed_applet/WordCloud.php');
    //create_wordcloud('test', 'embed_applet/', 'embed_applet/data/text_to_textmine.txt',  'embed_applet/data/stopwords.txt', 'embed_applet/data/bio-stopwords.txt.', 'embed_applet/data/other-stopwords.txt', 0);
	create_wordcloud_weights('test2', 'embed_applet/', 'Hello 4 World 4',  'embed_applet/data/stopwords.txt', 'embed_applet/data/bio-stopwords.txt.', 'embed_applet/data/other-stopwords.txt');

?> 

		<!-- #EndEditable "content" --></div>
	<!-- End Content -->
	<!-- Begin Footer -->
	<div id="footer">
		<p><a href="../indexOLD.html">Abstract</a> | 
		<a href="../runnertest/Project1/output">Relational Database</a> | 
		<a href="../data/default.html">Datasets</a> 
		| 
		<a href="../images_gallery/main_figures.html">Main Figures</a> |
		<a href="../movies/default.html">Movies</a> | 
		<a href="../tools/default.html">Tools</a> | 
		<a href="../laboratories/default.html">Laboratories</a></p>
	</div>
	<!-- End Footer --></div>
<!-- End Container -->

</body>

<!-- #EndTemplate -->

</html>
