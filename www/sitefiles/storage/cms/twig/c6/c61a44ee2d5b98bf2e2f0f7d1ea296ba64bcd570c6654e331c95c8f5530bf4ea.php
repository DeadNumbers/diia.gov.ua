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

/* /var/www/sitefiles/themes/diia/pages/pageIframe.htm */
class __TwigTemplate_61388e82e4b66aecfed83cefe82af655c3d763b356ccbe66ad8aec7f1cab1b0f extends \Twig\Template
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
<section class=\"content-wrapper\">
\t<div class=\"row\">
\t\t<div class=\"col-md-9\">
\t\t\t";
        // line 6
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, false, 6)) > 0)) {
            // line 7
            echo "\t\t\t\t<div class=\"editor-content\">
\t\t\t\t\t";
            // line 8
            echo twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, false, 8);
            echo "
\t\t\t\t</div>
\t\t\t";
        }
        // line 11
        echo "
\t\t\t";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "raw_sections", [], "any", false, false, false, 12));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            if (twig_get_attribute($this->env, $this->source, $context["section"], "published", [], "any", false, false, false, 12)) {
                // line 13
                echo "\t\t\t\t";
                $context['__cms_partial_params'] = [];
                $context['__cms_partial_params']['data'] = twig_get_attribute($this->env, $this->source, $context["section"], "fields", [], "any", false, false, false, 13)                ;
                echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction(("site/sections/" . twig_get_attribute($this->env, $this->source, $context["section"], "name", [], "any", false, false, false, 13))                , $context['__cms_partial_params']                , true                );
                unset($context['__cms_partial_params']);
                // line 14
                echo "\t\t\t";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "\t\t</div>
\t</div>
</section>

";
        // line 19
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 20
        echo "\t<script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/static.bundle.js"]);
        echo "\"></script>
";
        // line 19
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/pageIframe.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 19,  85 => 20,  83 => 19,  77 => 15,  70 => 14,  64 => 13,  59 => 12,  56 => 11,  50 => 8,  47 => 7,  45 => 6,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/pageIframe.htm", "");
    }
}
