<?php

/* businesscustomer.html */
class __TwigTemplate_0594bd9eff62f94b7d93419439b404364cee5c73e764ff77118079f1c91d1178 extends Twig_Template
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
<head>
    <title>Business Customer</title>
</head>
<body>
<h1>";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["customer"] ?? null), "getName", [], "method"), "html", null, true);
        echo "</h1>
<ul>
    <li>Tax Code           : ";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["customer"] ?? null), "getTaxCode", [], "method"), "html", null, true);
        echo "</li>
    <li>PDV Code           : ";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["customer"] ?? null), "getPdvCode", [], "method"), "html", null, true);
        echo "</li>
    <li><a href=\"http://bank-project.loc/customer/business/edit/";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["customer"] ?? null), "getId", [], "method"), "html", null, true);
        echo "\">Edit</a></li>

</ul>



</body>
</html>";
    }

    public function getTemplateName()
    {
        return "businesscustomer.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 11,  40 => 10,  36 => 9,  31 => 7,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
<head>
    <title>Business Customer</title>
</head>
<body>
<h1>{{customer.getName()}}</h1>
<ul>
    <li>Tax Code           : {{customer.getTaxCode()}}</li>
    <li>PDV Code           : {{customer.getPdvCode()}}</li>
    <li><a href=\"http://bank-project.loc/customer/business/edit/{{ customer.getId() }}\">Edit</a></li>

</ul>



</body>
</html>", "businesscustomer.html", "/home/keyblader/courses/phpclasses/templates/businesscustomer.html");
    }
}
