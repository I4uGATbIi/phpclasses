<?php

/* CustomersAndAccounts.html */
class __TwigTemplate_efa07781cfc99b0949cbe2b0ae01710a68cd4d3533a2436a0105b9ae0d1b219e extends Twig_Template
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
    <title>";
        // line 4
        echo twig_escape_filter($this->env, ($context["dataType"] ?? null), "html", null, true);
        echo "</title>
</head>
<body>
<h1>";
        // line 7
        echo twig_escape_filter($this->env, ($context["dataType"] ?? null), "html", null, true);
        echo "</h1>
<ul>
    ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["dataUnit"]) {
            // line 10
            echo "    <li><a href=\"http://bank-project.loc/";
            echo twig_escape_filter($this->env, ($context["link"] ?? null), "html", null, true);
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["dataUnit"], "getId", [], "method"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["dataUnit"], "getData", [], "method"), "html", null, true);
            echo "</a></li>

    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dataUnit'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "</ul>

<a href=\"http://bank-project.loc/";
        // line 15
        echo twig_escape_filter($this->env, ($context["link"] ?? null), "html", null, true);
        echo "new\">Create new</a>
<a href=\"http://bank-project.loc\">Home</a>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "CustomersAndAccounts.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 15,  56 => 13,  43 => 10,  39 => 9,  34 => 7,  28 => 4,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
<head>
    <title>{{dataType}}</title>
</head>
<body>
<h1>{{dataType}}</h1>
<ul>
    {% for dataUnit in data %}
    <li><a href=\"http://bank-project.loc/{{link}}{{ dataUnit.getId() }}\">{{dataUnit.getData()}}</a></li>

    {% endfor %}
</ul>

<a href=\"http://bank-project.loc/{{link}}new\">Create new</a>
<a href=\"http://bank-project.loc\">Home</a>
</body>
</html>", "CustomersAndAccounts.html", "/home/keyblader/courses/phpclasses/templates/CustomersAndAccounts.html");
    }
}
