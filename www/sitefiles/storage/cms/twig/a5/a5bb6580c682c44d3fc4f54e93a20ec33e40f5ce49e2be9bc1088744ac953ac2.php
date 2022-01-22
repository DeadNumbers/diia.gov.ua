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

/* /var/www/sitefiles/themes/diia/pages/page.htm */
class __TwigTemplate_dc08ffdbf17210ce9f389e9167134f845d95d0d6d94af9313b15a150f4542f9b extends \Twig\Template
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
        $context["page"] = twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 1);
        // line 2
        echo "
";
        // line 3
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/breadcrumbs"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 4
        echo "
<section>
\t<div class=\"container\">
\t    <div class=\"row\">
\t        <div class=\"col-12\">
\t            <div class=\"page_title\">
\t                <h1 class=\"page_title-text\">";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "title", [], "any", false, false, false, 10), "html", null, true);
        echo "</h1>
\t                <div class=\"page_title-date\">";
        // line 11
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["post"] ?? null), "published_at", [], "any", false, false, false, 11), "d/m/Y"), "html", null, true);
        echo "</div>
\t            </div>
\t            ";
        // line 13
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "tags", [], "any", false, false, false, 13))) {
            // line 14
            echo "\t\t            <div class=\"tag_wrap tag_wrap_static-page\">
\t\t                ";
            // line 15
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "tags", [], "any", false, false, false, 15));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 16
                echo "\t\t                \t<a href=\"";
                echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["tag"], "url", [], "any", false, false, false, 16));
                echo "\" class=\"tag\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tag"], "name", [], "any", false, false, false, 16), "html", null, true);
                echo "</a>
\t\t                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "\t\t            </div>
\t            ";
        }
        // line 20
        echo "\t        </div>
\t\t\t<div class=\"col-md-9\">
\t\t\t\t<div class=\"editor-content js-editor-content\">
\t\t\t\t\t";
        // line 23
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, false, 23)) > 0)) {
            // line 24
            echo "\t\t\t\t\t\t";
            echo twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, false, 24);
            echo "
\t\t\t\t\t";
        }
        // line 26
        echo "
\t\t\t\t\t";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "raw_sections", [], "any", false, false, false, 27));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            if (twig_get_attribute($this->env, $this->source, $context["section"], "published", [], "any", false, false, false, 27)) {
                // line 28
                echo "\t\t\t\t\t\t";
                $context['__cms_partial_params'] = [];
                $context['__cms_partial_params']['data'] = twig_get_attribute($this->env, $this->source, $context["section"], "fields", [], "any", false, false, false, 28)                ;
                echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction(("site/sections/" . twig_get_attribute($this->env, $this->source, $context["section"], "name", [], "any", false, false, false, 28))                , $context['__cms_partial_params']                , true                );
                unset($context['__cms_partial_params']);
                // line 29
                echo "\t\t\t\t\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "\t\t\t\t</div>
\t\t\t\t";
        // line 31
        if ((twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "slug", [], "any", false, false, false, 31) == "speedtest")) {
            // line 32
            echo "\t\t\t\t<div class=\"pb-60\">
\t\t\t\t\t<script type=\"text/javascript\" src=\"https://form.jotform.com/jsform/211661780507051\"></script>
\t\t\t\t</div>
\t\t\t\t";
        }
        // line 36
        echo "\t\t\t</div>
\t    </div>
    </div>
</section>

";
        // line 50
        echo "
";
        // line 51
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 52
        echo "\t<script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/static.bundle.js"]);
        echo "\"></script>
";
        // line 51
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/page.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 51,  144 => 52,  142 => 51,  139 => 50,  132 => 36,  126 => 32,  124 => 31,  121 => 30,  114 => 29,  108 => 28,  103 => 27,  100 => 26,  94 => 24,  92 => 23,  87 => 20,  83 => 18,  72 => 16,  68 => 15,  65 => 14,  63 => 13,  58 => 11,  54 => 10,  46 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/page.htm", "");
    }
}
