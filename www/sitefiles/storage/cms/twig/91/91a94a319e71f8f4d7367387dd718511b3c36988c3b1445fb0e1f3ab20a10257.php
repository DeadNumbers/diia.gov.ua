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

/* /var/www/sitefiles/themes/diia/partials/posts/items.htm */
class __TwigTemplate_2e6ff38a1ccccabd03e9389f94c85bfc1a2732589fd02fbbb50fda341a49314b extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "posts", [], "any", false, false, false, 1));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 2
            echo "    <div class=\"col-sm-6 col-lg-4\">
        <div class=\"posts_item\">
            ";
            // line 4
            if (twig_first($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "featured_images", [], "any", false, false, false, 4))) {
                // line 5
                echo "                <a href=\"";
                echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 5));
                echo "\" class=\"posts_item-preview\" style=\"background-image:url('";
                echo KitSoft\Resizer\Twig\Filters::resize(twig_get_attribute($this->env, $this->source, twig_first($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "featured_images", [], "any", false, false, false, 5)), "path", [], "any", false, false, false, 5), 1280);
                echo "')\"></a>
            ";
            } else {
                // line 7
                echo "                <a href=\"";
                echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 7));
                echo "\" class=\"posts_item-preview\" style=\"background-image:url(' ";
                echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/posts_item-preview.svg");
                echo "')\"></a>
            ";
            }
            // line 9
            echo "            <a href=\"";
            echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 9));
            echo "\" class=\"posts_item-title\">
                ";
            // line 10
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 10), "html", null, true);
            echo "
            </a>
            <div class=\"posts_item-date\">
                ";
            // line 13
            echo twig_escape_filter($this->env, ((twig_get_attribute($this->env, $this->source, $context["item"], "published_at", [], "any", false, false, false, 13)) ? (twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "published_at", [], "any", false, false, false, 13), "d/m/Y")) : (twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "created_at", [], "any", false, false, false, 13), "d/m/Y"))), "html", null, true);
            echo "
            </div>
        </div>
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "
";
        // line 20
        echo "
<div
    id=\"pagination-info\"
    class=\"hidden d-none\"
    data-total=\"";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "posts", [], "any", false, false, false, 24), "total", [], "any", false, false, false, 24), "html", null, true);
        echo "\"
    data-currentpage=\"";
        // line 25
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "posts", [], "any", false, false, false, 25), "currentPage", [], "any", false, false, false, 25), "html", null, true);
        echo "\"
    data-lastpage=\"";
        // line 26
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "posts", [], "any", false, false, false, 26), "lastPage", [], "any", false, false, false, 26), "html", null, true);
        echo "\"
></div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/posts/items.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 26,  98 => 25,  94 => 24,  88 => 20,  85 => 18,  74 => 13,  68 => 10,  63 => 9,  55 => 7,  47 => 5,  45 => 4,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/posts/items.htm", "");
    }
}
