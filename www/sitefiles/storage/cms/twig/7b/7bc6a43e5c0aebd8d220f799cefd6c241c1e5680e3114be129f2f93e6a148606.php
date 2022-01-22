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

/* /var/www/sitefiles/themes/diia/pages/pageSimple.htm */
class __TwigTemplate_26bcd1f76dc8106f37e483ff37bbd56ff322a7cab03e9a2a6d8689d1bf074ba6 extends \Twig\Template
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
        echo "<div class=\"privacy_body\">
    <div class=\"privacy_container\">
        <div class=\"privacy_header\">
            <div class=\"privacy_header-link-w\">
                <a href=\"";
        // line 5
        echo KitSoft\Core\Twig\UrlFilter::url("/");
        echo "\" class=\"privacy_header-link\">
                    <img src=\"";
        // line 6
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/mail-logo-reverse.png");
        echo "\" alt=\"logo\" class=\"privacy_header-img img-fluid\">
                </a>
            </div>
            <div class=\"privacy_header-title\">
                ";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 10), "title", [], "any", false, false, false, 10), "html", null, true);
        echo "
            </div>
        </div>
        <div class=\"privacy_content\">
            <div class=\"editor-content\">
                ";
        // line 15
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 15), "content", [], "any", false, false, false, 15);
        echo "

                ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 17), "raw_sections", [], "any", false, false, false, 17));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            if (twig_get_attribute($this->env, $this->source, $context["section"], "published", [], "any", false, false, false, 17)) {
                // line 18
                echo "                    ";
                $context['__cms_partial_params'] = [];
                $context['__cms_partial_params']['data'] = twig_get_attribute($this->env, $this->source, $context["section"], "fields", [], "any", false, false, false, 18)                ;
                echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction(("site/sections/" . twig_get_attribute($this->env, $this->source, $context["section"], "name", [], "any", false, false, false, 18))                , $context['__cms_partial_params']                , true                );
                unset($context['__cms_partial_params']);
                // line 19
                echo "                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "
            </div>
        </div>
    </div>
</div>

";
        // line 26
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 27
        echo "    <script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/static.bundle.js"]);
        echo "\"></script>
";
        // line 26
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/pageSimple.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 26,  95 => 27,  93 => 26,  85 => 20,  78 => 19,  72 => 18,  67 => 17,  62 => 15,  54 => 10,  47 => 6,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/pageSimple.htm", "");
    }
}
