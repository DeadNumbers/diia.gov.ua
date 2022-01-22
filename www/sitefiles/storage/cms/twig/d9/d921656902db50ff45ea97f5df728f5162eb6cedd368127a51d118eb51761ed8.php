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

/* /var/www/sitefiles/plugins/kitsoft/services/components/service/pdf.htm */
class __TwigTemplate_48bc6662da2749cccff2fb12caaa2bfb05e0cd86694ea7c12b22ba287778ad73 extends \Twig\Template
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
        echo "<html>
\t<head></head>
\t\t<body>
\t\t";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["pdfSections"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 5
            echo "\t\t    ";
            $context['__cms_partial_params'] = [];
            $context['__cms_partial_params']['data'] = twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 5)            ;
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction(("site/sections/inlinerender/" . twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 5))            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 6
            echo "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "\t</body>
</html>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/plugins/kitsoft/services/components/service/pdf.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 7,  52 => 6,  46 => 5,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/plugins/kitsoft/services/components/service/pdf.htm", "");
    }
}
