<?php

/* NewDeposit.html */
class __TwigTemplate_5b83009728cced44012a4083392dcd604ce37d3c8d490e5226088855121561fd extends Twig_Template
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
<html>
<form method=\"post\" action=\"/account/deposit/save\">
    <input type=\"hidden\" name=\"customerId\" value=\"";
        // line 4
        echo twig_escape_filter($this->env, ($context["customerId"] ?? null), "html", null, true);
        echo "\">
    <label for=\"accID\">AccID</label>
    <input name=\"accID\">
    <label for=\"price\">Start Deposit</label>
    <input name=\"price\">
    <br>
    <label for=\"percent\">Choose Percent</label>
    <select name=\"percent\">
        <option>15</option>
        <option>20</option>
    </select>
    <br>
    <button type=\"submit\" formaction=\"/account/deposit/save\">Open</button>

</form>

</html>";
    }

    public function getTemplateName()
    {
        return "NewDeposit.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 4,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
<form method=\"post\" action=\"/account/deposit/save\">
    <input type=\"hidden\" name=\"customerId\" value=\"{{customerId}}\">
    <label for=\"accID\">AccID</label>
    <input name=\"accID\">
    <label for=\"price\">Start Deposit</label>
    <input name=\"price\">
    <br>
    <label for=\"percent\">Choose Percent</label>
    <select name=\"percent\">
        <option>15</option>
        <option>20</option>
    </select>
    <br>
    <button type=\"submit\" formaction=\"/account/deposit/save\">Open</button>

</form>

</html>", "NewDeposit.html", "/home/keyblader/courses/phpclasses/templates/NewDeposit.html");
    }
}
