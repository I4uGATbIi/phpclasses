<?php

/* physicalcustomer.html */
class __TwigTemplate_c182b07f1ca55c6d7c136cf4788b2ea8188c5c6f46edbe9f393a2ef82097cac0 extends Twig_Template
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
    <title>Physical Customer</title>
</head>
<body>
<h1>";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["customer"] ?? null), "getLastName", [], "method"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["customer"] ?? null), "getFirstName", [], "method"), "html", null, true);
        echo "</h1>
<ul>
    <li>Age           : ";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["customer"] ?? null), "getAge", [], "method"), "html", null, true);
        echo "</li>
    <li>IPN           : ";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["customer"] ?? null), "getIPN", [], "method"), "html", null, true);
        echo "</li>
    <li>Passport Code : ";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["customer"] ?? null), "getPassportCode", [], "method"), "html", null, true);
        echo "</li>
    <li><a href=\"http://bank-project.loc/customer/physical/edit/";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["customer"] ?? null), "getId", [], "method"), "html", null, true);
        echo "\">Edit</a></li>


    ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["methods"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 16
            echo "    <li>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["customer"] ?? null), $context["method"]), "html", null, true);
            echo "</li>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "
</ul>


</body>
</html>";
    }

    public function getTemplateName()
    {
        return "physicalcustomer.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 19,  60 => 16,  56 => 15,  50 => 12,  46 => 11,  42 => 10,  38 => 9,  31 => 7,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
<head>
    <title>Physical Customer</title>
</head>
<body>
<h1>{{customer.getLastName()}} {{customer.getFirstName()}}</h1>
<ul>
    <li>Age           : {{customer.getAge()}}</li>
    <li>IPN           : {{customer.getIPN()}}</li>
    <li>Passport Code : {{customer.getPassportCode()}}</li>
    <li><a href=\"http://bank-project.loc/customer/physical/edit/{{ customer.getId() }}\">Edit</a></li>


    {% for method in methods %}
    <li>{{attribute(customer,method)}}</li>

    {% endfor %}

</ul>


</body>
</html>", "physicalcustomer.html", "/home/keyblader/courses/phpclasses/templates/physicalcustomer.html");
    }
}
