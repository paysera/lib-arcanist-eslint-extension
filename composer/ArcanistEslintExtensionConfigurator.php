<?php

namespace Paysera\Composer;

class ArcanistEslintExtensionConfigurator
{
    const LOAD = 'vendor/paysera/lib-arcanist-eslint-extension/src/';
    const ESLINT_BIN = 'node_modules/.bin/eslint';
    const ARC_CONFIG = '.arcconfig';
    const LINT_FILE = '.arclint';
    const ESLINT_CONFIG = '.eslintrc';

    public static function configure()
    {
        self::configureArcLint();
        self::configureArcConfig();
    }

    private static function configureArcConfig()
    {
        $arcConfig = [];
        if (file_exists(self::ARC_CONFIG)) {
            $arcConfig = json_decode(file_get_contents(self::ARC_CONFIG), true);
        }

        if (!isset($arcConfig['load'])) {
            $arcConfig['load'] = [self::LOAD];
        } elseif (!in_array(self::LOAD, $arcConfig['load'], true)) {
            $arcConfig['load'][] = self::LOAD;
        }

        file_put_contents(self::ARC_CONFIG, stripslashes(json_encode($arcConfig, JSON_PRETTY_PRINT)));
    }

    private static function configureArcLint()
    {
        $arcLint = [];
        if (file_exists(self::LINT_FILE)) {
            $arcLint = json_decode(file_get_contents(self::LINT_FILE), true);
        }

        if (!isset($arcLint['linters']['eslint']['type'])) {
            $arcLint['linters']['eslint']['type'] = 'eslint';
        }
        if (!isset($arcLint['linters']['eslint']['bin'])) {
            $arcLint['linters']['eslint']['bin'] = self::ESLINT_BIN;
        }
        if (!isset($arcLint['linters']['eslint']['eslint.config'])) {
            $arcLint['linters']['eslint']['eslint.config'] = self::ESLINT_CONFIG;
        }
        if (!isset($arcLint['linters']['eslint']['include'])) {
            $arcLint['linters']['eslint']['include'] = '(\\\\.js$)';
        } else {
            $arcLint['linters']['eslint']['include'] = addslashes($arcLint['linters']['eslint']['include']);
        }

        file_put_contents(self::LINT_FILE, stripslashes(json_encode($arcLint, JSON_PRETTY_PRINT)));
    }
}
