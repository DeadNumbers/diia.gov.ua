<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks/big.htm */
class __TwigTemplate_a2fdf125520d563544e4b38ae31a6a011c543326871e0ba2cbf732f2cbe7060b extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"col-12\">
\t<div class=\"service-acc_big\">
\t\t<div class=\"service-acc_big-inner\">
\t\t\t<div class=\"col-lg-7\">
\t\t\t\t";
        // line 5
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "text", [], "any", false, false, false, 5)) {
            // line 6
            echo "\t\t\t\t\t<div class=\"service-acc_big-title\">
\t\t\t\t\t\t";
            // line 7
            echo twig_replace_filter(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "text", [], "any", false, false, false, 7), ["&nbsp;" => " "]);
            echo "
\t\t\t\t\t</div>
\t\t\t\t";
        }
        // line 10
        echo "\t\t\t\t";
        if (twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 10)), "title", [], "any", false, false, false, 10)) {
            // line 11
            echo "\t\t\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 11)), "url", [], "any", false, false, false, 11), "html", null, true);
            echo "\" 
\t\t\t\t\t\t";
            // line 12
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 12), "target", [], "any", false, false, false, 12)) {
                echo "target=\"_blank\" ";
            }
            // line 13
            echo "\t\t\t\t\t\tclass=\"btn_default\">
\t\t\t\t\t\t<span>";
            // line 14
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 14)), "title", [], "any", false, false, false, 14), "html", null, true);
            echo "</span>
\t\t\t\t\t</a>
\t\t\t\t";
        }
        // line 17
        echo "\t\t\t</div>
\t\t</div>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks/big.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 17,  69 => 14,  66 => 13,  62 => 12,  57 => 11,  54 => 10,  48 => 7,  45 => 6,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks/big.htm", "");
    }
}
