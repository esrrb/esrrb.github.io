<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
   <head>
       <title>Welcome!</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   </head>
   <body>
	<h1> Example of a WordCloud!</h1>
	<p>The text is taken from the file text_to_textmine.txt.</p>
	<?php
		include ('WordCloud.php');
		create_wordcloud("1", "", "data/text_to_textmine.txt", "data/stopwords.txt", "data/bio-stopwords.txt", "data/other-stopwords.txt", 3);
		create_wordcloud_weights("2","", "stem 39 embryonic 25 differentiated 23 pluripotent 22 regulate 20 oct4 18 es 18 transcription 14 self-renewal 13 bind 12 sox2 11 germ 9 maintain 8 repress 8 complex 7 signal 7 target 7 overexpression 7 region 7 regulatory 6 methylated 6 endoderm 6 undifferentiated 6 reprogrammed 6 state 6 pathway 5 proliferating 5 unique 5 domain 5 marker 5 inhibit 5 carcinoma 5 tumor 5 develop 5 knockdown 5 process 5 klf4 5 homeodomain 4 specific 4 describe 4 network 4 downstream 4 stage 4 genome 4 pou5f1 4 primordial 3 phenotype 3 prevents 3 lineage 3 msin3a-hdac 3 cooperate 3 recruited 3 provide 3 downregulated 3 manner 3 oct3/4 3 leads 3 smad 3 suppressed 3 direct 3 oct-4 3 support 3 vitro 3 klf5 3 act 3 phosphorylation 3 proximal 3 hesc 3 fate 3 primitive 3 complete 3 member 3 form 3 sites 3 cancer 3 directly 3 maintenance 3 nuclear 3", "data/stopwords.txt", "data/bio-stopwords.txt", "data/other-stopwords.txt");
		?>
   </body>
</html>

