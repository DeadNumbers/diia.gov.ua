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

/* /var/www/sitefiles/plugins/kitsoft/core/components/googleanalytics/default.htm */
class __TwigTemplate_db74393a38c6a3f6a12f183e8ebcef196f25db79409a487c1aa26a4e24503b5f extends \Twig\Template
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
        if (twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "code", [], "any", false, false, false, 1)) {
            // line 2
            echo "    ";
            if ((twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "type", [], "any", false, false, false, 2) == "ga")) {
                // line 3
                echo "\t\t<!-- Global site tag (gtag.js) - Google Analytics -->
\t\t<script async src=\"https://www.googletagmanager.com/gtag/js?id=";
                // line 4
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "code", [], "any", false, false, false, 4), "html", null, true);
                echo "\"></script>
\t\t<script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            ";
                // line 8
                if ((twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "interdomainTracking", [], "any", false, false, false, 8) && twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "domains", [], "any", false, false, false, 8))) {
                    // line 9
                    echo "                gtag('set', 'linker', {
                    'domains': [";
                    // line 10
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "domains", [], "any", false, false, false, 10));
                    foreach ($context['_seq'] as $context["_key"] => $context["site"]) {
                        echo "'";
                        echo twig_escape_filter($this->env, $context["site"], "html", null, true);
                        echo "',";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['site'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    echo "]
                });
            ";
                }
                // line 13
                echo "            gtag('js', new Date());
            gtag('config', '";
                // line 14
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "code", [], "any", false, false, false, 14), "html", null, true);
                echo "');
\t\t</script>
    ";
            } elseif ((twig_get_attribute($this->env, $this->source,             // line 16
($context["__SELF__"] ?? null), "type", [], "any", false, false, false, 16) == "gtm")) {
                // line 17
                echo "\t\t<!-- Google Tag Manager -->
\t\t<script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','";
                // line 23
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "code", [], "any", false, false, false, 23), "html", null, true);
                echo "');
\t\t</script>
\t\t<!-- End Google Tag Manager -->
    ";
            }
        }
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/plugins/kitsoft/core/components/googleanalytics/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 23,  82 => 17,  80 => 16,  75 => 14,  72 => 13,  57 => 10,  54 => 9,  52 => 8,  45 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/plugins/kitsoft/core/components/googleanalytics/default.htm", "");
    }
}
