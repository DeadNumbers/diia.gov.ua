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

/* /var/www/sitefiles/plugins/kitsoft/services/components/service/info.htm */
class __TwigTemplate_7df8fe38e2fea8781bbfc0521bcea160f77fca2c75da49be2060113c2f3b806f extends \Twig\Template
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
        $context['_seq'] = twig_ensure_traversable(($context["sections"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 2
            echo "    ";
            $context['__cms_partial_params'] = [];
            $context['__cms_partial_params']['data'] = twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 2)            ;
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction(("site/sections/mailrender/" . twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 2))            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/plugins/kitsoft/services/components/service/info.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/plugins/kitsoft/services/components/service/info.htm", "");
    }
}
