<?php

/* index.html */
class __TwigTemplate_91c8011cfd1b45e95adcf4ee3acb3fceca42fdea4c57342e46af00bd7dcf7a5e extends Twig_Template
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
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <title>Welcome!</title>
</head>
<body>
<form method=\"get\">
    <br><br><br><br><br><br><br>
    <button type=\"submit\" formaction=\"/customers/physical\">Get Physical Customers</button>
    <button type=\"submit\" formaction=\"/customers/business\">Get Business Customer</button>
    <br><br><br><br><br><br><br>
    <button type=\"submit\" formaction=\"/accounts/deposit/\">Get Deposit Accounts</button>
    <button type=\"submit\" formaction=\"/accounts/credit/\">Get Credit Accounts</button>
    <br><br><br><br><br><br><br>
    <button type=\"submit\" formaction=\"/migrate/\">Migrate DB</button>
</form>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <title>Welcome!</title>
</head>
<body>
<form method=\"get\">
    <br><br><br><br><br><br><br>
    <button type=\"submit\" formaction=\"/customers/physical\">Get Physical Customers</button>
    <button type=\"submit\" formaction=\"/customers/business\">Get Business Customer</button>
    <br><br><br><br><br><br><br>
    <button type=\"submit\" formaction=\"/accounts/deposit/\">Get Deposit Accounts</button>
    <button type=\"submit\" formaction=\"/accounts/credit/\">Get Credit Accounts</button>
    <br><br><br><br><br><br><br>
    <button type=\"submit\" formaction=\"/migrate/\">Migrate DB</button>
</form>
</body>
</html>", "index.html", "/home/keyblader/courses/phpclasses/templates/index.html");
    }
}
