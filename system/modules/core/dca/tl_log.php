<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Core
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Table tl_log
 */
$GLOBALS['TL_DCA']['tl_log'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'closed'                      => true,
		'notEditable'                 => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list'  => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('tstamp DESC', 'id DESC'),
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('tstamp', 'text'),
			'format'                  => '<span style="color:#b3b3b3;padding-right:3px">[%s]</span> %s',
			'maxCharacters'           => 96,
			'label_callback'          => array('tl_log', 'colorize')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_log']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_log']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_log']['tstamp'],
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 6,
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'source' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_log']['source'],
			'filter'                  => true,
			'sorting'                 => true,
			'reference'               => &$GLOBALS['TL_LANG']['tl_log'],
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'action' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_log']['action'],
			'filter'                  => true,
			'sorting'                 => true,
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'username' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_log']['username'],
			'search'                  => true,
			'filter'                  => true,
			'sorting'                 => true,
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'text' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_log']['text'],
			'search'                  => true,
			'sql'                     => "text NULL"
		),
		'func' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_log']['func'],
			'sorting'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'ip' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_log']['ip'],
			'sorting'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'browser' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_log']['browser'],
			'sorting'                 => true,
			'search'                  => true,
			'sql'                     => "varchar(255) NOT NULL default ''"
		)
	)
);


/**
 * Class tl_log
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2013
 * @author     Leo Feyer <https://contao.org>
 * @package    Core
 */
class tl_log extends Backend
{

	/**
	 * Colorize the log entries depending on their category
	 * @param array
	 * @param string
	 * @return string
	 */
	public function colorize($row, $label)
	{
		switch ($row['action'])
		{
			case 'CONFIGURATION':
			case 'REPOSITORY':
				$label = preg_replace('@^(.*</span> )(.*)$@U', '$1 <span class="tl_blue">$2</span>', $label);
				break;

			case 'CRON':
				$label = preg_replace('@^(.*</span> )(.*)$@U', '$1 <span class="tl_green">$2</span>', $label);
				break;

			case 'ERROR':
				$label = preg_replace('@^(.*</span> )(.*)$@U', '$1 <span class="tl_red">$2</span>', $label);
				break;
		}

		return $label;
	}
}
