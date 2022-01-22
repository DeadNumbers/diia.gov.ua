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

/* /var/www/sitefiles/plugins/kitsoft/taxsystems/components/taxsystem/pdf.htm */
class __TwigTemplate_76d2fbb2de0f0f1eca86e73f2e7d0c473763345fc67964453dba5d751afca32d extends \Twig\Template
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
        echo "<!DOCTYPE html>

<head>
    <meta http-equiv=\"Content-Type\" content=\"charset=utf-8\" />
    <meta charset=\"utf-8\">
    <style>
    @font-face {
        font-family: 'e-ukraine';
        src: url(";
        // line 9
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/fonts/e-Ukraine-new/e-Ukraine-Regular.ttf");
        echo ") format(\"truetype\");
    }

    #test-fop_print-pdf *:empty {
        /* display: none !important; */
    }

    #test-fop_print-pdf * {
        font-family: 'e-ukraine' !important;
        font-weight: 400 !important;
        line-height: normal !important;
        font-size: 16px !important;
    }

    #test-fop_print-pdf .test-fop_result-info {
        border: 2px solid #000;
        padding: 0 10px 0 20px;
    }

    #test-fop_print-pdf .test-fop_result .h5 {
        margin: 10px 0 20px !important;
    }

    #test-fop_print-pdf .test-fop_content-title {
        font-size: 30px !important;
        line-height: 36px !important;
        margin: 0 !important;
    }

    /* display: NONE */
    #test-fop_print-pdf a .icon,
    #test-fop_print-pdf .embed-responsive,
    #test-fop_print-pdf iframe,
    #test-fop_print-pdf br,
    #test-fop_print-pdf [data-empty~=true],
    #test-fop_print-pdf *:before,
    #test-fop_print-pdf *:after,
    #test-fop_print-pdf table,
    #test-fop_print-pdf .fr-fic,
    #test-fop_print-pdf .fr-dii {
        display: none !important
    }

    /* display: NONE */
    #test-fop_print-pdf h1,
    #test-fop_print-pdf .h1,
    #test-fop_print-pdf h2,
    #test-fop_print-pdf .h2,
    #test-fop_print-pdf .h2-3,
    #test-fop_print-pdf h3,
    #test-fop_print-pdf .h3,
    #test-fop_print-pdf h4,
    #test-fop_print-pdf h5,
    #test-fop_print-pdf h6,
    #test-fop_print-pdf .h4,
    #test-fop_print-pdf .h5,
    #test-fop_print-pdf .h6 {
        margin-top: 30px !important;
        margin-bottom: 20px !important;
        font-weight: 400 !important;
        color: #000 !important;
    }

    #test-fop_print-pdf h1,
    #test-fop_print-pdf .h1 {
        font-size: 32px !important;
    }


    #test-fop_print-pdf h2,
    #test-fop_print-pdf .h2 {
        font-size: 28px !important;
    }

    #test-fop_print-pdf h3,
    #test-fop_print-pdf .h3 {
        font-size: 24px !important;
    }

    #test-fop_print-pdf h4,
    #test-fop_print-pdf h5,
    #test-fop_print-pdf h6,
    #test-fop_print-pdf .h4,
    #test-fop_print-pdf .h5,
    #test-fop_print-pdf .h6 {
        font-size: 20px !important;
    }

    #test-fop_print-pdf p {}

    #test-fop_print-pdf p a,
    #test-fop_print-pdf p span {
        font-size: inherit !important;
        font-family: \"e-ukraine\" !important;
        line-height: inherit !important;
        font-weight: inherit !important
    }

    #test-fop_print-pdf p strong {
        font-size: inherit !important;
        font-family: \"e-ukraine\" !important;
        line-height: inherit !important
    }

    #test-fop_print-pdf p img {
        display: block;
        width: auto !important;
        max-width: 100% !important;
        margin-bottom: 15px;
        margin-left: auto !important;
        margin-right: auto !important
    }

    #test-fop_print-pdf pre {
        display: inline-block !important;
        margin-bottom: 15px !important;
        border: 0 !important;
        background-color: transparent !important
    }

    #test-fop_print-pdf pre:first-child {
        float: left !important;
        margin-bottom: 0 !important
    }

    #test-fop_print-pdf pre:last-child {
        float: right;
        text-transform: uppercase;
        margin-right: 70px;
        margin-bottom: 0
    }

    #test-fop_print-pdf div p {
        margin-bottom: 15px !important
    }

    #test-fop_print-pdf img {
        margin: 15px 0 20px !important;
        display: block !important;
        max-width: 100% !important
    }

    #test-fop_print-pdf a {
        font-size: inherit !important;
        font-family: \"e-ukraine\" !important;
        line-height: inherit !important;
        font-weight: inherit !important;
        transition: .2s ease-in-out !important;
        border: none !important;
        text-decoration: underline !important;
        color: #000 !important
    }

    #test-fop_print-pdf .not-blockquote {
        padding: 10px 20px !important;
        margin: 0 0 20px !important;
        border-left: 5px solid #eee !important
    }

    #test-fop_print-pdf blockquote:not(.not-blockquote) {
        display: block !important;
        margin: 40px 0 !important;
        max-width: 700px !important;
        position: relative !important;
        color: #000 !important;
        font-family: \"e-ukraine\" !important;
        font-size: 20px !important;
        line-height: 30px !important;
        padding: 0 25px !important
    }

    #test-fop_print-pdf blockquote:not(.not-blockquote) p {
        margin: 0 !important
    }

    #test-fop_print-pdf small {
        font-size: 16px !important;
    }

    #test-fop_print-pdf a[target] {
        padding-right: 0 !important;
        position: relative !important;
        display: inline !important;
    }

    #test-fop_print-pdf a[target] span {
        position: relative !important;
        transition: .3s ease-in-out !important
    }

    #test-fop_print-pdf>*:first-child {
        margin-top: 0 !important
    }

    /* 
    * {
        -webkit-print-color-adjust: economy;
        print-color-adjust: economy
    }
    
    @page {
        margin: 1.5cm
    } 
    */

    #test-fop_print-pdf *,
    #test-fop_print-pdf p,
    #test-fop_print-pdf div {
        margin: 10px 0 !important;
    }

    #test-fop_print-pdf span,
    #test-fop_print-pdf b,
    #test-fop_print-pdf strong,
    #test-fop_print-pdf a {
        margin: 0 !important
    }

    #test-fop_print-pdf ol,
    #test-fop_print-pdf ul {
        margin: 0 !important;
    }

    #test-fop_print-pdf ol li ol li,
    #test-fop_print-pdf ol li ul li,
    #test-fop_print-pdf ul li ol li,
    #test-fop_print-pdf ul li ul li {
        font-size: 16px !important;
    }

    #test-fop_print-pdf .service-acc_big {
        padding: 5px 0
    }

    #test-fop_print-pdf .service-acc_big-inner {
        padding: 5px 20px;
        border: 2px solid #000
    }

    </style>
</head>

<body id=\"test-fop_print-pdf\">
    <section class=\"test-fop_wrap\">
        <div class=\"test-fop_container\">
            <div class=\"test-fop_result\">
                <div class=\"test-fop_head\">
                    <div class=\"col-6 pl-0\">
                        <div class=\"test-fop_head-logo-big\">
                            <a href=\"";
        // line 258
        echo url("/");
        echo "\">
                                <div class=\"icn-logo_gerb-b\"></div>
                                <div class=\"icn-logo_diia-b\"></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class=\"test-fop_content-title\">
                    ";
        // line 266
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, false, 266), "html", null, true);
        echo "
                </div>
                <div class=\"test-fop_content-res\">
                    ";
        // line 269
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 269), "info", [], "any", false, false, false, 269), "title", [], "any", false, false, false, 269)) {
            // line 270
            echo "                    <div class=\"h5\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 270), "info", [], "any", false, false, false, 270), "title", [], "any", false, false, false, 270), "html", null, true);
            echo "</div>
                    <div class=\"test-fop_result-info\">
                        <div class=\"test-fop_result-bg\">
                            ";
            // line 273
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 273), "info", [], "any", false, false, false, 273), "items", [], "any", false, false, false, 273));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 274
                echo "                            <div class=\"test-fop_result-info-item\">
                                <div class=\"test-fop_result-info-title\">";
                // line 275
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 275), "html", null, true);
                echo "</div>
                                <div class=\"test-fop_result-info-sub\">";
                // line 276
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 276), "html", null, true);
                echo "</div>
                            </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 279
            echo "                        </div>
                    </div>
                    ";
        }
        // line 282
        echo "                    ";
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "content", [], "any", false, false, false, 282))) {
            // line 283
            echo "                        <div class=\"editor-content editor-content_test-fop\">
                            ";
            // line 284
            echo twig_replace_filter(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "content", [], "any", false, false, false, 284), ["&nbsp;" => " "]);
            echo "
                        </div>
                    ";
        }
        // line 287
        echo "                </div>
            </div>
        </div>
    </section>
</body>

</html>
";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/plugins/kitsoft/taxsystems/components/taxsystem/pdf.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  362 => 287,  356 => 284,  353 => 283,  350 => 282,  345 => 279,  336 => 276,  332 => 275,  329 => 274,  325 => 273,  318 => 270,  316 => 269,  310 => 266,  299 => 258,  47 => 9,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/plugins/kitsoft/taxsystems/components/taxsystem/pdf.htm", "");
    }
}
