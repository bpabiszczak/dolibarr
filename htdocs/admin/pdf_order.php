<?php
/* Copyright (C) 2001-2005 	Rodolphe Quiedeville 	<rodolphe@quiedeville.org>
 * Copyright (C) 2004-2012 	Laurent Destailleur  	<eldy@users.sourceforge.net>
 * Copyright (C) 2005-2011 	Regis Houssin        	<regis.houssin@inodbox.com>
 * Copyright (C) 2012-2107 	Juanjo Menent			<jmenent@2byte.es>
 * Copyright (C) 2019	   	Ferran Marcet			<fmarcet@2byte.es>
 * Copyright (C) 2021		Anthony Berton       	<bertonanthony@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

/**
 *       \file       htdocs/admin/pdf.php
 *       \brief      Page to setup PDF options
 */

require '../main.inc.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formother.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formadmin.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/usergroups.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/pdf.lib.php';

// Load translation files required by the page
$langs->loadLangs(array('admin', 'languages', 'other', 'companies', 'products', 'members', 'stocks', 'Trips'));

if (!$user->admin) {
	accessforbidden();
}

$action = GETPOST('action', 'aZ09');
$cancel = GETPOST('cancel', 'alpha');


/*
 * Actions
 */

if ($cancel) {
	$action = '';
}

if ($action == 'update') {
	setEventMessages($langs->trans("SetupSaved"), null, 'mesgs');

	header("Location: ".$_SERVER["PHP_SELF"]."?mainmenu=home&leftmenu=setup");
	exit;
}



/*
 * View
 */

$wikihelp = 'EN:First_setup|FR:Premiers_param&eacute;trages|ES:Primeras_configuraciones';
llxHeader('', $langs->trans("Setup"), $wikihelp);

$form = new Form($db);
$formother = new FormOther($db);
$formadmin = new FormAdmin($db);

print load_fiche_titre($langs->trans("PDF"), '', 'title_setup');

$head = pdf_admin_prepare_head();

print dol_get_fiche_head($head, 'order', $langs->trans("Order"), -1, 'pdf');

print '<span class="opacitymedium">'.$form->textwithpicto($langs->trans("PDFOrderDesc"), $s)."</span><br>\n";
print "<br>\n";

print '<form method="post" action="'.$_SERVER["PHP_SELF"].'">';
print '<input type="hidden" name="token" value="'.newToken().'">';
print '<input type="hidden" name="action" value="update">';

print '<div class="div-table-responsive-no-min">';
print '<table summary="more" class="noborder centpercent">';
print '<tr class="liste_titre"><td>'.$langs->trans("Parameter").'</td><td width="200px">'.$langs->trans("Value").'</td></tr>';


print '<tr class="oddeven"><td>'.$langs->trans("").'</td><td>';

print '</td></tr>';

print '</table>';
print '</div>';


print '<br><div class="center">';
print '<input class="button button-save" type="submit" name="save" value="'.$langs->trans("Save").'">';
print '</div>';

print '</form>';


// End of page
llxFooter();
$db->close();