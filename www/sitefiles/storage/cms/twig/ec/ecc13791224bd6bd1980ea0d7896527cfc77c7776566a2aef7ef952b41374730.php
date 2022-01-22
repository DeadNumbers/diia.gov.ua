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

/* /var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks/items.htm */
class __TwigTemplate_aab25c4a9804ad856fa2feab3c0b83658d0ca54174824f46eb467a3aec327d83 extends \Twig\Template
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
        if (twig_length_filter($this->env, ($context["items"] ?? null))) {
            // line 2
            echo "    <div class=\"col-lg-6\">
    \t";
            // line 3
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 3) == "simple")) {
                    // line 4
                    echo "\t\t     ";
                    $context['__cms_partial_params'] = [];
                    $context['__cms_partial_params']['item'] = $context["item"]                    ;
                    echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/sections/serviceInfoBlocks/simple"                    , $context['__cms_partial_params']                    , true                    );
                    unset($context['__cms_partial_params']);
                    // line 5
                    echo "\t\t";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 6
            echo "    </div>
\t
\t";
            // line 8
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 8) == "big")) {
                    // line 9
                    echo "\t    ";
                    $context['__cms_partial_params'] = [];
                    $context['__cms_partial_params']['item'] = $context["item"]                    ;
                    echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/sections/serviceInfoBlocks/big"                    , $context['__cms_partial_params']                    , true                    );
                    unset($context['__cms_partial_params']);
                    // line 10
                    echo "\t";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 11
            echo "    
";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks/items.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 11,  75 => 10,  69 => 9,  64 => 8,  60 => 6,  53 => 5,  47 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocks/items.htm", "");
    }
}
