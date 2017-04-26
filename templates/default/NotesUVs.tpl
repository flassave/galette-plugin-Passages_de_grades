<form action="NotesUVs.php" method="get" id="filtre">
        <table class="infoline">
            <tr>
                <td class="left">{$nb_members} {if $nb_members != 1}{_T string="members"}{else}{_T string="member"}{/if}</td>
            </tr>
        </table>
        </form>
		<form action="NotesUVs.php" method="post" id="listform">
		
        <table class="listing">
            <thead>
				<th><a href="NotesUVs.php?tri=sname&order={$filter.to}">
                            {_T string="Name"}
                            {if $filter.tri == 'sname'}
                                {if $filter.order == 'SORT_ASC'}
                            <img src="{$template_subdir}images/down.png" width="10" height="6" alt=""/>
                                {else}
                            <img src="{$template_subdir}images/up.png" width="10" height="6" alt=""/>
                                {/if}
                            {/if}
                        </a>
				</th>
				<th> <center>Age</center> </th>
				<th> <center>Grade</center> </th>
				<th> <center>Ceinture</center> </th>
				<th> <center>UV1</center> </th>
				<th> <center>UV2</center> </th>
				<th> <center>UV3</center> </th>
				<th> <center>UV4</center> </th>
				<th> <center>UV5</center> </th>
				<th> <center>UV6</center> </th>
				<th><a href="NotesUVs.php?tri=moy&order={$filter.to}">
                            {_T string="Moy."}
                            {if $filter.tri == 'moy'}
                                {if $filter.order == 'SORT_ASC'}
                            <img src="{$template_subdir}images/down.png" width="10" height="6" alt=""/>
                                {else}
                            <img src="{$template_subdir}images/up.png" width="10" height="6" alt=""/>
                                {/if}
                            {/if}
                        </a>
				</th>
            </thead>
{if $nb_members != 0}

            <tfoot>
	            <tr>
				{if $login->isAdmin()}
                    <td colspan="7" id="table_footer">
                        <ul class="selection_menu">
                            <li>{_T string="For the selection:"}</li>
							<li><input type="submit" id="delete" onclick="return confirm('{_T string="Do you really want to delete all selected members ?"|escape:"javascript"}');" name="delete" value="{_T string="  Delete"}"/></li>
                        </ul>
                    </td>
				{/if}
                </tr>
				
	{if $login->isAdmin() or $login->isStaff()}
				<tr>
					<td colspan="7" id="table_foot">
						<li><input type="submit" name="csv" id="csv" value="{_T string="Export as CSV"}"/></li>
					</td>
				</tr>
	{/if}
            </tfoot>
{/if}
            <tbody>
{foreach from=$allnotes key=k item=i}
	
	{if $i.id_adh!="0"}
				
				<tr>
					<td class="{$rclass} nowrap username_row">
                       {if $login->isAdmin()}<input type="checkbox" name="member_sel[]" value="{$i.id_adh}"/>&nbsp;&nbsp;{/if}<a href="{$galette_base_path}{$PassagesDeGrades_dir}PassagesDeGrades.php?id_adh={$i.id_adh}"><u>{$i.sname}{$member->sname}{if $member->company_name} ({$member->company_name}){/if}</u></FONT></a></td>
					<td><center>{$i.age}</center></td>
					<td><center>
						{$i.grade}
						{if $i.barrettes!="-" and $i.barrettes!=""}{_T string="- "}{$i.barrettes}{/if}
					</center></td>
					{if $i.ceinture=="templates/default/images/icon-warning.png"}
						<td><center><img src={$i.ceinture} width="16"/></center></td> 
					{else}
						<td><center><img src={$i.ceinture} width="64"/></center></td> 
					{/if}
					{if $i.uv1 == "0"}
						<td bgcolor="#F9CECE" width="50"><center>{$i.uv1}</center></td>
					{elseif $i.uv1 == ""}
						<td bgcolor="#FF0000" width="50"><center>{$i.uv1}</center></td>
					{else}
						<td width="50"><center>{$i.uv1}</center></td>
					{/if}
					{if $i.uv2 == "0"}
						<td bgcolor="#F9CECE" width="50"><center>{$i.uv2}</center></td>
					{elseif $i.uv2 == ""}
						<td bgcolor="#FF0000" width="50"><center>{$i.uv2}</center></td>
					{else}
						<td width="50"><center>{$i.uv2}</center></td>
					{/if}
					{if $i.uv3 == "0"}
						<td bgcolor="#F9CECE" width="50"><center>{$i.uv3}</center></td>
					{elseif $i.uv3 == ""}
						<td bgcolor="#FF0000" width="50"><center>{$i.uv3}</center></td>
					{else}
						<td width="50"><center>{$i.uv3}</center></td>
					{/if}
					{if $i.uv4 == "0"}
						<td bgcolor="#F9CECE" width="50"><center>{$i.uv4}</center></td>
					{elseif $i.uv4 == ""}
						<td bgcolor="#FF0000" width="50"><center>{$i.uv4}</center></td>
					{else}
						<td width="50"><center>{$i.uv4}</center></td>
					{/if}
					{if $i.uv5 == "0"}
						<td bgcolor="#F9CECE" width="50"><center>{$i.uv5}</center></td>
					{elseif $i.uv5 == ""}
						<td bgcolor="#FF0000" width="50"><center>{$i.uv5}</center></td>
					{else}
						<td width="50"><center>{$i.uv5}</center></td>
					{/if}
					{if $i.uv6 == "0"}
						<td bgcolor="#F9CECE" width="50"><center>{$i.uv6}</center></td>
					{elseif $i.uv6 == ""}
						<td bgcolor="#FF0000" width="50"><center>{$i.uv6}</center></td>
					{else}
						<td width="50"><center>{$i.uv6}</center></td>
					{/if}
					<td><center>{$i.moy}</center></td>
				</tr>
				<th colspan="11">   </th>
	{/if}
	
{foreachelse}
                <tr><td colspan="11" class="emptylist">{_T string="No member has been found"}</td></tr>
	
{/foreach}
            </tbody>
        </table>
        </form>
        <script type="text/javascript">
{if $nb_members != 0}
        var _is_checked = true;
        var _bind_check = function(){
            $('#checkall').click(function(){
                $('table.listing :checkbox[name="member_sel[]"]').each(function(){
                    this.checked = _is_checked;
                });
                _is_checked = !_is_checked;
                return false;
            });
            $('#checkinvert').click(function(){
                $('table.listing :checkbox[name="member_sel[]"]').each(function(){
                    this.checked = !$(this).is(':checked');
                });
                return false;
            });
        }
		$('#table_foot').parent().before('<tr><th  id="listing" colspan="10"><b><center>Moyenne Générale</center></b></th><td border bordercolor="#FFB619"><center>{$mgle}</center></td></tr>');
            _bind_check();
            $('#nbshow').change(function() {
                this.form.submit();
            });
		$('#table_footer').parent().before('<tr><td id="checkboxes" colspan="4"><span class="fleft"><a href="#" id="checkall">{_T string="(Un)Check all"}</a> | <a href="#" id="checkinvert">{_T string="Invert selection"}</a></span></td></tr>');
            _bind_check();
            $('#nbshow').change(function() {
                this.form.submit();
            });
{/if}
        </script>		

