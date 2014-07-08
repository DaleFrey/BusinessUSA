<h1>BusinessUSA</h1>

<h2>SVN Version: <?php print codebaseStatus('Last Changed Rev'); ?></h2>

<h2>Tag Version: <?php readfile('mytag.txt'); ?></h2>

<h2>Environment Flag: <?php print version_awareness_env(); ?></h2>

<h2>version_awareness_environment_isproduction() returns: <?php print ( version_awareness_environment_isproduction() ? 'true' : 'false' );?></h2>