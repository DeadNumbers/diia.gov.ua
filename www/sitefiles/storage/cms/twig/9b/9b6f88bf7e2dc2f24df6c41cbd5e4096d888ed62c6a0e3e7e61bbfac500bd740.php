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

/* /var/www/sitefiles/themes/diia/partials/site/cookie.htm */
class __TwigTemplate_af4b21cc50f40cda3f8df04b3f41870b0ce38487eb1eb3af68a1c4171a8521d0 extends \Twig\Template
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
        echo "<div class=\"scrollbar cookies js-cookies\">
    <div class=\"cookies-1 js-cookies-1\">
        <div class=\"cookies-1_close\"></div>
        <div class=\"cookies-1_title\">Файли Cookie</div>
        <div class=\"cookies-1_info\">
            Дія не зберігає дані, але використовує cookies щоб працювати правильно.
            Натисніть «Дозволити всі», якщо ви погоджуєтесь на використання порталом цих файлів.
        </div>
        <div class=\"cookies-1_btn-wrap\">
            <a href=\"javascript:void(0)\" class=\"btn btn-fill cookies-1_btn cookies-1_btn-1\">Дозволити всі</a>
            <a href=\"javascript:void(0)\" class=\"btn btn_default cookies-1_btn cookies-1_btn-2\">
                <span>Налаштувати</span>
            </a>
        </div>
    </div>
    <div class=\"cookies-2 js-cookies-2\">
        <div class=\"cookies-2_close\"></div>
        <div class=\"cookies-2_title\">Центр налаштування конфіденційності</div>
        <div class=\"cookies-2_info\">
            Ваш браузер зберігає та отримує інформацію у формі cookie файлів.
            Вона може стосуватись вас, ваших інтересів або вашого пристрою.
            Ця інформація не ідентифікує безпосередньо вас, але персоналізує ваш вебдосвід.
            Файли cookie потрібні для того, щоб персоналізувати ваше користування Порталом
            та зробити його приємнішим і зручнішим.
        </div>
        <div class=\"cookies-2-acc_wrap\">
            <div class=\"cookies-2-acc_i\">
                <div class=\"cookies-2-acc_i-top\">
                    <div class=\"cookies-2-acc_i-check agree_wrap\">
                        <label for=\"test-1\" class=\"agree_wrap-inner disabled\">
                            <input id=\"test-1\" class=\"checkbox disabled\" type=\"checkbox\" name=\"\" value=\"\" checked>
                            <label for=\"test-1\"></label>
                        </label>
                    </div>
                    <div class=\"cookies-2-acc_i-text\">Обов’язкові файли cookie</div>
                    <div class=\"cookies-2-acc_i-btn js-cookies-2-acc_i-btn\"></div>
                </div>
                <div class=\"cookies-2-acc_collapse collapse\">
                    <div class=\"cookies-2-acc_i-info\">
                        Вони потрібні, щоб реагувати на ваші запити, початок сеансу,
                        авторизацію чи заповнення форм. Ви можете налаштувати свій браузер так,
                        щоб він блокував ці файли або ж сповіщав про їх використання.
                        У такому разі деякі частини Порталу не працюватимуть.
                        Cookie не зберігають особисту інформацію
                    </div>
                </div>
            </div>
            ";
        // line 69
        echo "            ";
        // line 93
        echo "            ";
        // line 116
        echo "        </div>
        <div class=\"cookies-2_btn-wrap\">
            <a href=\"javascript:void(0)\" class=\"btn btn-fill cookies-2_btn cookies-2_btn-1 js-cookies-2_btn-1\">Дозволити всі</a>
            ";
        // line 124
        echo "        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/cookie.htm";
    }

    public function getDebugInfo()
    {
        return array (  95 => 124,  90 => 116,  88 => 93,  86 => 69,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/cookie.htm", "");
    }
}
