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

/* /var/www/sitefiles/themes/diia/pages/poll.htm */
class __TwigTemplate_9f888d20a16572afad06a93800263d8774a3fed95e17e28da242ee571a7a682e extends \Twig\Template
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
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/breadcrumbs"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 2
        echo "
<section>
    <div class=\"container\">
        <div class=\"row\">
            ";
        // line 6
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 6), "title", [], "any", false, false, false, 6)) {
            // line 7
            echo "            <div class=\"col-12\">
                <div class=\"page_title\">
                    ";
            // line 9
            if (twig_in_filter("зворотного зв’язку", twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 9), "title", [], "any", false, false, false, 9))) {
                // line 10
                echo "                        <div class=\"page_title-text\"></div>
                    ";
            } else {
                // line 12
                echo "                        <h1 class=\"page_title-text\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 12), "title", [], "any", false, false, false, 12), "html", null, true);
                echo "</h1>
                    ";
            }
            // line 14
            echo "                </div>
            </div>
            ";
        }
        // line 17
        echo "            <div class=\"col-md-10 col-lg-9\">
                <div id=\"poll\">
                    ";
        // line 19
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("poll"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 20
        echo "                </div>
            </div>
        </div>
    </div>
</section>

";
        // line 26
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 27
        echo "    <script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/poll.bundle.js"]);
        echo "\"></script>
";
        // line 26
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/poll.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 26,  88 => 27,  86 => 26,  78 => 20,  74 => 19,  70 => 17,  65 => 14,  59 => 12,  55 => 10,  53 => 9,  49 => 7,  47 => 6,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/poll.htm", "");
    }
}
