<?php

/* noresults.html */
class __TwigTemplate_8358e418ff95ae41b7845af3020f5463b2deff8ac1713656bf4bcef28129a1ca extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "

<!DOCTYPE html>
<html lang=\"en\">
<head>
    <title>SHIT!</title>
</head>
<body>
<label>Nothing found in our DB</label>
<br>
<label>Redirecting in 10 secs</label>
<br>
<br>
<br>
<meta http-equiv=\"refresh\" content=\"10;url=http://bank-project.loc/\" />
<a href=\"http://bank-project.loc\">Home</a>
<br>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "noresults.html";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("

<!DOCTYPE html>
<html lang=\"en\">
<head>
    <title>SHIT!</title>
</head>
<body>
<label>Nothing found in our DB</label>
<br>
<label>Redirecting in 10 secs</label>
<br>
<br>
<br>
<meta http-equiv=\"refresh\" content=\"10;url=http://bank-project.loc/\" />
<a href=\"http://bank-project.loc\">Home</a>
<br>
</body>
</html>", "noresults.html", "/home/keyblader/courses/phpclasses/templates/noresults.html");
    }
}
