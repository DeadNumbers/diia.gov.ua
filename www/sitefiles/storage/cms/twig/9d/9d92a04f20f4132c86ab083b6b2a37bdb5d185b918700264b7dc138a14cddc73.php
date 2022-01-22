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

/* /var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks/simple.htm */
class __TwigTemplate_fb2b37f606ab818402f95aa4a7be44661be6ea39e26791e4ac41bc20d8a91c67 extends \Twig\Template
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
        echo "<div class=\"service-acc_simple\">
    ";
        // line 2
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "text", [], "any", false, false, false, 2)) {
            // line 3
            echo "        <div class=\"service-acc_simple-text editor-content editor-content_service-acc\">
            ";
            // line 4
            echo twig_replace_filter(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "text", [], "any", false, false, false, 4), ["&nbsp;" => " "]);
            echo "
        </div>
    ";
        }
        // line 7
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 7)), "title", [], "any", false, false, false, 7)) {
            // line 8
            echo "        <a href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 8)), "url", [], "any", false, false, false, 8), "html", null, true);
            echo "\" ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 8), "target", [], "any", false, false, false, 8)) {
                echo "target=\"_blank\" ";
            }
            echo " class=\"btn_default\">
            <span>";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 9)), "title", [], "any", false, false, false, 9), "html", null, true);
            echo "</span>
        </a>
    ";
        }
        // line 12
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks/simple.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 12,  63 => 9,  54 => 8,  51 => 7,  45 => 4,  42 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks/simple.htm", "");
    }
}
