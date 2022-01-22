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

/* /var/www/sitefiles/themes/diia/partials/site/openGraph.htm */
class __TwigTemplate_d0914d28bdc3858308a4c78aea94471302f14f2c103c86701b12dca75250a54a extends \Twig\Template
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
        $context["og"] = twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Functions::partial("og"), "fields", [], "any", false, false, false, 1);
        // line 2
        echo "
<meta property=\"og:url\" content=\"";
        // line 3
        echo call_user_func_array($this->env->getFunction('url_current')->getCallable(), ["current"]);
        echo "\" />
<meta property=\"og:title\" content=\"";
        // line 4
        echo twig_escape_filter($this->env, (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, true, false, 4), "meta_title", [], "any", true, true, false, 4) &&  !(null === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, true, false, 4), "meta_title", [], "any", false, false, false, 4)))) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, true, false, 4), "meta_title", [], "any", false, false, false, 4)) : (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 4), "title", [], "any", false, false, false, 4))), "html", null, true);
        echo "\" />
<meta property=\"og:description\" content=\"";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 5), "meta_description", [], "any", false, false, false, 5), "html", null, true);
        echo "\" />

";
        // line 7
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 7), "og_image", [], "any", false, false, false, 7)) {
            // line 8
            echo "    <meta property=\"og:image\" content=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 8), "og_image", [], "any", false, false, false, 8), "html", null, true);
            echo "\" />
";
        } elseif (twig_get_attribute($this->env, $this->source,         // line 9
($context["og"] ?? null), "image", [], "any", false, false, false, 9)) {
            // line 10
            echo "    <meta property=\"og:image\" content=\"";
            echo url($this->extensions['System\Twig\Extension']->mediaFilter(twig_get_attribute($this->env, $this->source, ($context["og"] ?? null), "image", [], "any", false, false, false, 10)));
            echo "\" />
";
        } else {
            // line 12
            echo "    <meta property=\"og:image\" content=\"";
            echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/default_photo.png");
            echo "\" />
";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/openGraph.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 12,  64 => 10,  62 => 9,  57 => 8,  55 => 7,  50 => 5,  46 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/openGraph.htm", "");
    }
}
