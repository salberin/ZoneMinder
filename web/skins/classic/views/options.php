<?php
//
// ZoneMinder web options view file, $Date$, $Revision$
// Copyright (C) 2003, 2004, 2005, 2006  Philip Coombes
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
//

if ( !canView( 'System' ) )
{
    $_REQUEST['view'] = "error";
    return;
}

$tabs = array();
$tabs['system'] = $SLANG['System'];
$tabs['config'] = $SLANG['Config'];
$tabs['paths'] = $SLANG['Paths'];
$tabs['web'] = $SLANG['Web'];
$tabs['images'] = $SLANG['Images'];
$tabs['debug'] = $SLANG['Debug'];
$tabs['network'] = $SLANG['Network'];
$tabs['mail'] = $SLANG['Email'];
$tabs['ftp'] = $SLANG['FTP'];
$tabs['x10'] = $SLANG['X10'];
$tabs['highband'] = $SLANG['HighBW'];
$tabs['medband'] = $SLANG['MediumBW'];
$tabs['lowband'] = $SLANG['LowBW'];
$tabs['phoneband'] = $SLANG['PhoneBW'];
if ( ZM_OPT_USE_AUTH )
    $tabs['users'] = $SLANG['Users'];

if ( !isset($_REQUEST['tab']) )
    $_REQUEST['tab'] = "system";

$focusWindow = true;

xhtmlHeaders( __FILE__, $SLANG['Options'] );
?>
<body>
  <div id="page">
    <div id="header">
      <h2><?= $SLANG['Options'] ?></h2>
    </div>
    <div id="content">
      <ul class="tabList">
<?php
foreach ( $tabs as $name=>$value )
{
    if ( $_REQUEST['tab'] == $name )
    {
?>
        <li class="active"><?= $value ?></li>
<?php
    }
    else
    {
?>
        <li><a href="?view=<?= $_REQUEST['view'] ?>&tab=<?= $name ?>"><?= $value ?></a></li>
<?php
    }
}
?>
      </ul>
<?php 
if ( $_REQUEST['tab'] == "users" )
{
?>
      <form name="userForm" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="hidden" name="view" value="<?= $_REQUEST['view'] ?>"/>
        <input type="hidden" name="tab" value="<?= $_REQUEST['tab'] ?>"/>
        <input type="hidden" name="action" value="delete"/>
        <table id="contentTable" class="major userTable" cellspacing="0">
          <thead>
            <tr>
              <th class="colUsername"><?= $SLANG['Username'] ?></th>
              <th class="colLanguage"><?= $SLANG['Language'] ?></th>
              <th class="colEnabled"><?= $SLANG['Enabled'] ?></th>
              <th class="colStream"><?= $SLANG['Stream'] ?></th>
              <th class="colEvents"><?= $SLANG['Events'] ?></th>
              <th class="colControl"><?= $SLANG['Control'] ?></th>
              <th class="colMonitors"><?= $SLANG['Monitors'] ?></th>
              <th class="colSystem"><?= $SLANG['System'] ?></th>
              <th class="colBandwidth"><?= $SLANG['Bandwidth'] ?></th>
              <th class="colMonitor"><?= $SLANG['Monitor'] ?></th>
              <th class="colMark"><?= $SLANG['Mark'] ?></th>
            </tr>
          </thead>
          <tbody>
<?php
    $sql = "select * from Monitors order by Sequence asc";
    $monitors = array();
    foreach( dbFetchAll( $sql ) as $monitor )
    {
        $monitors[$monitor['Id']] = $monitor;
    }

    $sql = "select * from Users";
    foreach( dbFetchAll( $sql ) as $row )
    {
        $userMonitors = array();
        if ( !empty($row['MonitorIds']) )
        {
            foreach ( split( ",", $row['MonitorIds'] ) as $monitorId )
            {
                $userMonitors[] = $monitors[$monitorId]['Name'];
            }
        }
?>
            <tr>
              <td class="colUsername"><?= makePopupLink( '?view=user&uid='.$row['Id'], 'zmUser', 'user', $row['Username'].($user['Username']==$row['Username']?"*":""), canEdit( 'System' ) ) ?></td>
              <td class="colLanguage"><?= $row['Language']?$row['Language']:'default' ?></td>
              <td class="colEnabled"><?= $row['Enabled']?$SLANG['Yes']:$SLANG['No'] ?></td>
              <td class="colStream"><?= $row['Stream'] ?></td>
              <td class="colEvents"><?= $row['Events'] ?></td>
              <td class="colControl"><?= $row['Control'] ?></td>
              <td class="colMonitors"><?= $row['Monitors'] ?></td>
              <td class="colSystem"><?= $row['System'] ?></td>
              <td class="colBandwidth"><?= $row['MaxBandwidth']?$bwArray[$row['MaxBandwidth']]:'&nbsp;' ?></td>
              <td class="colMonitor"><?= $row['MonitorIds']?(join( ", ", $userMonitors )):"&nbsp;" ?></td>
              <td class="colMark"><input type="checkbox" name="markUids[]" value="<?= $row['Id'] ?>" onclick="configureButton( this, 'markUids' );"<?php if ( !canEdit( 'System' ) ) { ?> disabled="disabled"<?php } ?>/></td>
            </tr>
<?php
    }
?>
          </tbody>
        </table>
        <div id="contentButtons">
          <input type="button" value="<?= $SLANG['AddNewUser'] ?>" onclick="createPopup( '?view=user&uid=-1', 'zmUser', 'user' );"<?php if ( !canEdit( 'System' ) ) { ?> disabled="disabled"<?php } ?>/><input type="submit" name="deleteBtn" value="<?= $SLANG['Delete'] ?>" disabled="disabled"/><input type="button" value="<?= $SLANG['Cancel'] ?>" onclick="closeWindow();"/>
        </div>
      </form>
<?php
}
else
{
    if ( $_REQUEST['tab'] == "system" )
    {
        $configCats[$_REQUEST['tab']]['ZM_LANG_DEFAULT']['Hint'] = join( '|', getLanguages() );
    }
?>
      <form name="optionsForm" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="hidden" name="view" value="<?= $_REQUEST['view'] ?>"/>
        <input type="hidden" name="tab" value="<?= $_REQUEST['tab'] ?>"/>
        <input type="hidden" name="action" value="options"/>
        <table id="contentTable" class="major optionTable" cellspacing="0">
          <thead>
            <tr>
              <th><?= $SLANG['Name'] ?></th>
              <th><?= $SLANG['Description'] ?></th>
              <th><?= $SLANG['Value'] ?></th>
            </tr>
<?php
    $configCat = $configCats[$_REQUEST['tab']];

    foreach ( $configCat as $name=>$value )
    {
        $optionPromptIndex = preg_replace( '/^ZM_/', '', $option );
        $optionPromptText = !empty($OLANG[$optionPromptIndex])?$OLANG[$optionPromptIndex]:$config[$option]['Prompt'];
?>
            <tr>
              <td><?= $value['Name'] ?></td>
              <td><?= htmlentities($option_prompt_text) ?>&nbsp;(<?= makePopupLink( '?view=optionhelp&option='.$value['Name'], 'zmOptionHelp', 'optionhelp', '?' ) ?>)</td>
<?php   
        if ( $value['Type'] == "boolean" )
        {
?>
              <td><input type="checkbox" id="<?= $value['Name'] ?>" name="newConfig[<?= $value['Name'] ?>]" value="1"<?php if ( $value['Value'] ) { ?> checked="checked"<?php } ?>/></td>
<?php
        }
        elseif ( preg_match( "/\|/", $value['Hint'] ) )
        {
?>
              <td class="nowrap">
<?php
            $options = split( "\|", $value['Hint'] );
            if ( count( $options ) > 3 )
            {
?>
                <select name="newConfig[<?= $value['Name'] ?>] ?>">
<?php
                foreach ( $options as $option )
                {
?>
                  <option value="<?= $option ?>"<?php if ( $value['Value'] == $option ) { echo ' selected="selected"'; } ?>><?= htmlentities($option) ?></option>
<?php
                }
?>
                </select>
<?php
            }
            else
            {
                foreach ( $options as $option )
                {
?>
                <span><input type="radio" id="<?= $value['Name'] ?>" name="newConfig[<?= $value['Name'] ?>]" value="<?= $option ?>"<?php if ( $value['Value'] == $option ) { ?> checked="checked"<?php } ?>>&nbsp;<?= $option ?></span>
<?php
                }
            }
?>
              </td>
<?php
        }
        elseif ( $value['Type'] == "text" )
        {
?>
              <td><textarea id="<?= $value['Name'] ?>" name="newConfig[<?= $value['Name'] ?>]" rows="5" cols="40"><?= htmlspecialchars($value['Value']) ?></textarea></td>
<?php
        }
        elseif ( $value['Type'] == "integer" )
        {
?>
              <td><input type="text" id="<?= $value['Name'] ?>" name="newConfig[<?= $value['Name'] ?>]" value="<?= $value['Value'] ?>" class="small"/></td>
<?php
        }
        elseif ( $value['Type'] == "hexadecimal" )
        {
?>
              <td><input type="text" id="<?= $value['Name'] ?>" name="newConfig[<?= $value['Name'] ?>]" value="<?= $value['Value'] ?>" class="medium"/></td>
<?php
        }
        elseif ( $value['Type'] == "decimal" )
        {
?>
              <td><input type="text" id="<?= $value['Name'] ?>" name="newConfig[<?= $value['Name'] ?>]" value="<?= $value['Value'] ?>" class="small"/></td>
<?php
        }
        else
        {
?>
              <td><input type="text" id="<?= $value['Name'] ?>" name="newConfig[<?= $value['Name'] ?>]" value="<?= $value['Value'] ?>" class="large"/></td>
<?php
        }
?>
            </tr>
<?php
    }
?>
          </tbody>
        </table>
        <div id="contentButtons">
          <input type="submit" value="<?= $SLANG['Save'] ?>"/><input type="button" value="<?= $SLANG['Cancel'] ?>" onclick="closeWindow();"/>
        </div>
      </form>
<?php
}
?>
    </div>
  </div>
</body>
</html>