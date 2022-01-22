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

/* /var/www/sitefiles/themes/diia/partials/poll/step.htm */
class __TwigTemplate_1d0c3d08ac7570865b7d01950ea181f3a7323e48ad73fa578caf8f9b21a4eed6 extends \Twig\Template
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
        // line 12
        echo "
";
        // line 13
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "option", [], "any", false, false, false, 13), "action", [], "any", false, false, false, 13) == "question")) {
            // line 14
            echo "\t";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("poll::form"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        } elseif ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,         // line 15
($context["__SELF__"] ?? null), "option", [], "any", false, false, false, 15), "action", [], "any", false, false, false, 15) == "answer")) {
            // line 16
            echo "\t";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("poll::answer"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 17
            echo "
\t";
            // line 18
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "poll", [], "any", false, false, false, 18), "use_departments", [], "any", false, false, false, 18)) {
                // line 19
                echo "\t\t";
                $context['__cms_partial_params'] = [];
                echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("poll::location/location"                , $context['__cms_partial_params']                , true                );
                unset($context['__cms_partial_params']);
                // line 20
                echo "\t";
            }
        }
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/poll/step.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 20,  59 => 19,  57 => 18,  54 => 17,  49 => 16,  47 => 15,  42 => 14,  40 => 13,  37 => 12,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/poll/step.htm", "");
    }
}
