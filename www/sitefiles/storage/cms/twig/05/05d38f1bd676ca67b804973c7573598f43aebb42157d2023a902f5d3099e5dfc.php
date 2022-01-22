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

/* /var/www/sitefiles/themes/diia/pages/home.htm */
class __TwigTemplate_243004e5927c4577020214e4e6881beed53947fe9add5b363bf4411dd109c557 extends \Twig\Template
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
        // line 29
        echo "
";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 30), "sections", [], "any", false, false, false, 30));
        foreach ($context['_seq'] as $context["key"] => $context["item"]) {
            // line 31
            echo "\t";
            $context['__cms_partial_params'] = [];
            $context['__cms_partial_params']['data'] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 31), "sections", [], "any", false, false, false, 31), $context["key"], [], "any", false, false, false, 31), "fields", [], "any", false, false, false, 31)            ;
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction(("site/sections/" . $context["key"])            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "
";
        // line 34
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 35
        echo "\t<script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/home.bundle.js"]);
        echo "\"></script>
";
        // line 34
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/home.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 34,  59 => 35,  57 => 34,  54 => 33,  44 => 31,  40 => 30,  37 => 29,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/home.htm", "");
    }
}
