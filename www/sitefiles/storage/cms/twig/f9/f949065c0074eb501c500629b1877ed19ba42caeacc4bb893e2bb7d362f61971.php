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

/* /var/www/sitefiles/themes/diia/partials/site/sections/bannersHome.htm */
class __TwigTemplate_4ecf9350247339613fc0afad960018aca015c77c0f25aada92175c47a6a4d35c extends \Twig\Template
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
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "bannerPc", [], "any", false, false, false, 1)) && twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "bannerMobile", [], "any", false, false, false, 1)))) {
            // line 2
            echo "<section class=\"banner-top-v2\">
    <div class=\"container\">
        <div class=\"banner-top-v2_bg\">
            <a href=\"";
            // line 5
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "link", [], "any", false, false, false, 5), "html", null, true);
            echo "\"
               target=\"_blank\" rel=\"nofollow\"
               class=\"banner-top-v2_box\">
                <div class=\"banner-top-v2_item-desktop\">
                    ";
            // line 9
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "bannerPc", [], "any", false, false, false, 9));
            foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
                // line 10
                echo "                    <picture>
                        <source src=\"";
                // line 11
                echo $this->extensions['System\Twig\Extension']->mediaFilter(twig_get_attribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 11));
                echo "\" media=\"(min-width: 768px)\">
                        <img src=\"";
                // line 12
                echo $this->extensions['System\Twig\Extension']->mediaFilter(twig_get_attribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 12));
                echo "\"
                             alt=\"Державні послуги онлайн\"
                             class=\"banner-top-v2_item-image img-fluid\" loading=lazy>
                    </picture>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['banner'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            echo "                </div>
                <div class=\"banner-top-v2_item-mobile\">
                    ";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "bannerMobile", [], "any", false, false, false, 19));
            foreach ($context['_seq'] as $context["_key"] => $context["banner"]) {
                // line 20
                echo "                    <picture>
                        <source src=\"";
                // line 21
                echo $this->extensions['System\Twig\Extension']->mediaFilter(twig_get_attribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 21));
                echo "\" media=\"(max-width: 767px)\">
                        <img src=\"";
                // line 22
                echo $this->extensions['System\Twig\Extension']->mediaFilter(twig_get_attribute($this->env, $this->source, $context["banner"], "image", [], "any", false, false, false, 22));
                echo "\"
                             alt=\"Державні послуги онлайн\"
                             class=\"banner-top-v2_item-image img-fluid\" loading=lazy>
                    </picture>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['banner'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            echo "                </div>
            </a>
        </div>
    </div>
</section>
";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/bannersHome.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 27,  88 => 22,  84 => 21,  81 => 20,  77 => 19,  73 => 17,  62 => 12,  58 => 11,  55 => 10,  51 => 9,  44 => 5,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/bannersHome.htm", "");
    }
}
