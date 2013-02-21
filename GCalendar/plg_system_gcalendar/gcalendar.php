<?php
/**
 * GCalendar is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GCalendar is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with GCalendar.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package		GCalendar
 * @author		Digital Peak http://www.digital-peak.com
 * @copyright	Copyright (C) 2007 - 2013 Digital Peak. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

defined('_JEXEC') or die();

JLoader::import('joomla.plugin.plugin');
JLoader::import('components.com_gcalendar.util', JPATH_ADMINISTRATOR);

class plgSystemGCalendar extends JPlugin {

	public function onAfterRender() {
		if (!GCalendarUtil::isJoomlaVersion('2.5') || !JFactory::getApplication()->get('gcjQuery', false)) {
			return;
		}

		$body = JResponse::getBody();

		$body = preg_replace("#([\\\/a-zA-Z0-9_:\.-]*)jquery([0-9\.-]|min|pack)*?.js#", "", $body);
		$body = str_ireplace('<script src="" type="text/javascript"></script>', "", $body);
		$body = preg_replace("#/GCJQLIB#", JURI::root().'/components/com_gcalendar/libraries/jquery/jquery.min.js', $body);

		JResponse::setBody($body);
	}
}