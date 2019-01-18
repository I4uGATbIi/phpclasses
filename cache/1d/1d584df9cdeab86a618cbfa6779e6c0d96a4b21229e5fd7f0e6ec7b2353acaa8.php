<?php

/* CustomerOrAccount.html */
class __TwigTemplate_941895a99aaf4bdfc19f9f538418687c93039bfda138fa4722dbf9aefea9c0e9 extends Twig_Template
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
<form>
<h1>";
        // line 7
        echo twig_escape_filter($this->env, ($context["mainData"] ?? null), "html", null, true);
        echo "</h1>
<ul>

    ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["methods"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 11
            echo "    <li>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["object"] ?? null), $context["method"]), "html", null, true);
            echo "</li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "    <li><a href=\"http://bank-project.loc/";
        echo twig_escape_filter($this->env, ($context["link"] ?? null), "html", null, true);
        echo "edit/";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["object"] ?? null), "getId", [], "method"), "html", null, true);
        echo "\">Edit</a></li>

</ul>
<br>
<a href=\"http://bank-project.loc/\">Home</a>
";
        // line 18
        if (twig_in_filter("Customers", ($context["dataType"] ?? null))) {
            // line 19
            echo "    <ul>
    ";
            // line 20
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["accounts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["account"]) {
                // line 21
                echo "    <li><a href=\"http://bank-project.loc/account/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["account"], "getType", [], "method"), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["account"], "getId", [], "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["account"], "getData", [], "method"), "html", null, true);
                echo "</a></li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['account'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            echo "    </ul>
        <input type=\"hidden\" name=\"customerId\" value=\"";
            // line 24
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["object"] ?? null), "getId", [], "method"), "html", null, true);
            echo "\">
        <button type=\"submit\" formaction=\"/account/deposit/new\">Open Deposit Account</button>
        <button type=\"submit\" formaction=\"/account/credit/new\">Open Credit Account</button>
";
        }
        // line 28
        echo "
    </form>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "CustomerOrAccount.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 28,  89 => 24,  86 => 23,  73 => 21,  69 => 20,  66 => 19,  64 => 18,  53 => 13,  44 => 11,  40 => 10,  34 => 7,  28 => 4,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
<head>
    <title>{{dataType}}</title>
</head>
<form>
<h1>{{mainData}}</h1>
<ul>

    {% for method in methods %}
    <li>{{attribute(object,method)}}</li>
    {% endfor %}
    <li><a href=\"http://bank-project.loc/{{link}}edit/{{ object.getId() }}\">Edit</a></li>

</ul>
<br>
<a href=\"http://bank-project.loc/\">Home</a>
{% if 'Customers' in dataType %}
    <ul>
    {% for account in accounts %}
    <li><a href=\"http://bank-project.loc/account/{{account.getType()}}/{{account.getId()}}\">{{account.getData()}}</a></li>
    {% endfor %}
    </ul>
        <input type=\"hidden\" name=\"customerId\" value=\"{{object.getId()}}\">
        <button type=\"submit\" formaction=\"/account/deposit/new\">Open Deposit Account</button>
        <button type=\"submit\" formaction=\"/account/credit/new\">Open Credit Account</button>
{% endif %}

    </form>
</body>
</html>", "CustomerOrAccount.html", "/home/keyblader/courses/phpclasses/templates/CustomerOrAccount.html");
    }
}
