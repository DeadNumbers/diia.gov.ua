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

/* /var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks.htm */
class __TwigTemplate_8243f4e924cb1f3f59effeee50e341f2a6cd0a68da5d9d1c709c61bfccac77f4 extends \Twig\Template
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
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "items", [], "any", false, false, false, 1))) {
            // line 2
            echo "<section class=\"service-acc_section\" data-is-pdf-render=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "isPdfRender", [], "any", false, false, false, 2), "html", null, true);
            echo "\">
\t<div class=\"container\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-12\">
\t\t\t\t<div class=\"service-acc_item\">
\t\t\t\t\t<div class=\"service-acc_item-quest js-service-acc_item-quest\">
\t\t\t\t\t    ";
            // line 8
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "title", [], "any", false, false, false, 8), "html", null, true);
            echo "
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"collapse service-acc_simple-answer\">
                        <div class=\"row\">
\t\t\t\t\t\t\t";
            // line 12
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "items", [], "any", false, false, false, 12));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 13
                echo "                                ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 13)) {
                    // line 14
                    echo "                                    <div class=\"col-12 service-acc_simple-lead\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 14), "html", null, true);
                    echo "</div>
                                ";
                }
                // line 16
                echo "\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t";
                // line 17
                $context['__cms_partial_params'] = [];
                $context['__cms_partial_params']['items'] = twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 17), 0, twig_round((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 17)) / 2)))                ;
                echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/sections/serviceInfoBlocks/items"                , $context['__cms_partial_params']                , true                );
                unset($context['__cms_partial_params']);
                // line 18
                echo "\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t";
                // line 19
                $context['__cms_partial_params'] = [];
                $context['__cms_partial_params']['items'] = twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 19), twig_round((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 19)) / 2)))                ;
                echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/sections/serviceInfoBlocks/items"                , $context['__cms_partial_params']                , true                );
                unset($context['__cms_partial_params']);
                // line 20
                echo "\t\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</section>
";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 21,  85 => 20,  80 => 19,  77 => 18,  72 => 17,  69 => 16,  63 => 14,  60 => 13,  56 => 12,  49 => 8,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks.htm", "");
    }
}
