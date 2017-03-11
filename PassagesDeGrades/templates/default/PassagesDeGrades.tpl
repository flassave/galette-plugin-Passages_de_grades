<div class="clear"></div>
<form action="PassagesDeGrades.php?id_adh={$member->id}" method="post" >
<p>
<table class="listing" id="sortable">
<thead>
<th> Nom </th>
<th> <center>Age</center> </th>
<th> <center>Grade</center> </th>
<th> <center>Ceinture</center> </th>
</thead>


<tbody>
<tr><td>
<img
                        src="{$galette_base_path}picture.php?id_adh={$member->id}&amp;rand={$time}"
                        width="84"
                        height="100"
                        alt="{_T string="Picture"}"
                        id="photo_adh"/>&nbsp;&nbsp;<FONT SIZE="4"><u>{$member->sname}{if $member->company_name} ({$member->company_name}){/if}</u></FONT></td>
	<td><center>{$age}</center></td>
	<td><center>
		{$grade}</br>
		{if $barrettes!="-" and $barrettes!=""}{$barrettes}{/if}
	</center></td>
	{if $ceinture=="templates/default/images/icon-warning.png"}
		<td><center><img src={$ceinture} width="16"/></center></td> 
	{else}
		<td><center><img src={$ceinture} width="128"/></center></td> 
	{/if}
</tr>
<tr> </tr>
</tbody>
<tfoot> 
<th colspan="4">   </th>
</tfoot>
</table>

<div class="clear"></br></div>

<table class="listing" id="sortable">
<thead>
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv1'}
	<th> <center>UV1</center> </th>
{/if}
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv2'}
	<th> <center>UV2</center> </th>
{/if}
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv3'}
	<th> <center>UV3</center> </th>
{/if}
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv4'}
	<th> <center>UV4</center> </th>
{/if}
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv5'}
	<th> <center>UV5</center> </th>
{/if}
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv6'}
	<th> <center>UV6</center> </th>
{/if}
</thead>


<tbody>
<tr>
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv1'}
		<td><center>{$uv1}</center></td>
	{/if}
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv2'}
		<td><center>{$uv2}</center></td>
	{/if}
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv3'}
		<td><center>{$uv3}</center></td>
	{/if}
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv4'}
		<td><center>{$uv4}</center></td>
	{/if}
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv5'}
		<td><center>{$uv5}</center></td>
	{/if}
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv6'}
		<td><center>{$uv6}</center></td>
	{/if}
</tr>
<tr> </tr>
</tbody>
<tfoot> 
<th colspan="6">   </th>
</tfoot>
</table>

<div class="clear"></br></div>

<table class="listing" id="sortable">
<thead>
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv1'}
	<th> <center>UV1</center> </th>
{/if}
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv2'}
	<th> <center>UV2</center> </th>
{/if}
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv3'}
	<th> <center>UV3</center> </th>
{/if}
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv4'}
	<th> <center>UV4</center> </th>
{/if}
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv5'}
	<th> <center>UV5</center> </th>
{/if}
{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv6'}
	<th> <center>UV6</center> </th>
{/if}
</thead>



<tbody>
<tr>
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv1'}
		<td>
			<center><select name="val_uv1" size="1" style="width:48px; font-size:16px; ">
				
				   <option  selected="selected" class="64px">{$uv1}</option>
				   <option  value="0" class="64px">0</option>
				   <option  value="1" class="64px">1</option>
				   <option  value="2" class="64px">2</option>
				   <option  value="3" class="64px">3</option>
				   <option  value="4" class="64px">4</option>
				   <option  value="5" class="64px">5</option>
				   <option  value="6" class="64px">6</option>
				   <option  value="7" class="64px">7</option>
				   <option  value="8" class="64px">8</option>
				   <option  value="9" class="64px">9</option>
				   <option  value="10" class="64px">10</option>
				   <option  value="11" class="64px">11</option>
				   <option  value="12" class="64px">12</option>
				   <option  value="13" class="64px">13</option>
				   <option  value="14" class="64px">14</option>
				   <option  value="15" class="64px">15</option>
				   <option  value="16" class="64px">16</option>
				   <option  value="17" class="64px">17</option>
				   <option  value="18" class="64px">18</option>
				   <option  value="19" class="64px">19</option>
				   <option  value="20" class="64px">20</option>
			</select></center>
			
		</td>
	{/if}	
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv2'}
		<td>
			<center><select name="val_uv2" size="1" style="width:48px; font-size:16px;">
				
				   <option  selected="selected" class="64px">{$uv2}</option>
				   <option  value="0" class="64px">0</option>
				   <option  value="1" class="64px">1</option>
				   <option  value="2" class="64px">2</option>
				   <option  value="3" class="64px">3</option>
				   <option  value="4" class="64px">4</option>
				   <option  value="5" class="64px">5</option>
				   <option  value="6" class="64px">6</option>
				   <option  value="7" class="64px">7</option>
				   <option  value="8" class="64px">8</option>
				   <option  value="9" class="64px">9</option>
				   <option  value="10" class="64px">10</option>
				   <option  value="11" class="64px">11</option>
				   <option  value="12" class="64px">12</option>
				   <option  value="13" class="64px">13</option>
				   <option  value="14" class="64px">14</option>
				   <option  value="15" class="64px">15</option>
				   <option  value="16" class="64px">16</option>
				   <option  value="17" class="64px">17</option>
				   <option  value="18" class="64px">18</option>
				   <option  value="19" class="64px">19</option>
				   <option  value="20" class="64px">20</option>
			</select></center>
		</td>
	{/if}
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv3'}
		<td>
			<center><select name="val_uv3" size="1" style="width:48px; font-size:16px;">
				
				   <option  selected="selected" class="64px">{$uv3}</option>
				   <option  value="0" class="64px">0</option>
				   <option  value="1" class="64px">1</option>
				   <option  value="2" class="64px">2</option>
				   <option  value="3" class="64px">3</option>
				   <option  value="4" class="64px">4</option>
				   <option  value="5" class="64px">5</option>
				   <option  value="6" class="64px">6</option>
				   <option  value="7" class="64px">7</option>
				   <option  value="8" class="64px">8</option>
				   <option  value="9" class="64px">9</option>
				   <option  value="10" class="64px">10</option>
				   <option  value="11" class="64px">11</option>
				   <option  value="12" class="64px">12</option>
				   <option  value="13" class="64px">13</option>
				   <option  value="14" class="64px">14</option>
				   <option  value="15" class="64px">15</option>
				   <option  value="16" class="64px">16</option>
				   <option  value="17" class="64px">17</option>
				   <option  value="18" class="64px">18</option>
				   <option  value="19" class="64px">19</option>
				   <option  value="20" class="64px">20</option>
			</select></center>
		</td>
	{/if}
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv4'}
		<td>
			<center><select name="val_uv4" size="1" style="width:48px; font-size:16px;">
				
				   <option  selected="selected" class="64px">{$uv4}</option>
				   <option  value="0" class="64px">0</option>
				   <option  value="1" class="64px">1</option>
				   <option  value="2" class="64px">2</option>
				   <option  value="3" class="64px">3</option>
				   <option  value="4" class="64px">4</option>
				   <option  value="5" class="64px">5</option>
				   <option  value="6" class="64px">6</option>
				   <option  value="7" class="64px">7</option>
				   <option  value="8" class="64px">8</option>
				   <option  value="9" class="64px">9</option>
				   <option  value="10" class="64px">10</option>
				   <option  value="11" class="64px">11</option>
				   <option  value="12" class="64px">12</option>
				   <option  value="13" class="64px">13</option>
				   <option  value="14" class="64px">14</option>
				   <option  value="15" class="64px">15</option>
				   <option  value="16" class="64px">16</option>
				   <option  value="17" class="64px">17</option>
				   <option  value="18" class="64px">18</option>
				   <option  value="19" class="64px">19</option>
				   <option  value="20" class="64px">20</option>
			</select></center>
		</td>
	{/if}
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv5'}
		<td>
			<center><select name="val_uv5" size="1" style="width:48px; font-size:16px;">
				
				   <option  selected="selected" class="64px">{$uv5}</option>
				   <option  value="0" class="64px">0</option>
				   <option  value="1" class="64px">1</option>
				   <option  value="2" class="64px">2</option>
				   <option  value="3" class="64px">3</option>
				   <option  value="4" class="64px">4</option>
				   <option  value="5" class="64px">5</option>
				   <option  value="6" class="64px">6</option>
				   <option  value="7" class="64px">7</option>
				   <option  value="8" class="64px">8</option>
				   <option  value="9" class="64px">9</option>
				   <option  value="10" class="64px">10</option>
				   <option  value="11" class="64px">11</option>
				   <option  value="12" class="64px">12</option>
				   <option  value="13" class="64px">13</option>
				   <option  value="14" class="64px">14</option>
				   <option  value="15" class="64px">15</option>
				   <option  value="16" class="64px">16</option>
				   <option  value="17" class="64px">17</option>
				   <option  value="18" class="64px">18</option>
				   <option  value="19" class="64px">19</option>
				   <option  value="20" class="64px">20</option>
			</select></center>
		</td>
	{/if}
	{if $login->isAdmin() or $login->isStaff() or $login->login=='tableuv6'}
		<td>
			<center><select name="val_uv6" size="1" style="width:48px; font-size:16px;">
				
				   <option  selected="selected" class="64px">{$uv6}</option>
				   <option  value="0" class="64px">0</option>
				   <option  value="1" class="64px">1</option>
				   <option  value="2" class="64px">2</option>
				   <option  value="3" class="64px">3</option>
				   <option  value="4" class="64px">4</option>
				   <option  value="5" class="64px">5</option>
				   <option  value="6" class="64px">6</option>
				   <option  value="7" class="64px">7</option>
				   <option  value="8" class="64px">8</option>
				   <option  value="9" class="64px">9</option>
				   <option  value="10" class="64px">10</option>
				   <option  value="11" class="64px">11</option>
				   <option  value="12" class="64px">12</option>
				   <option  value="13" class="64px">13</option>
				   <option  value="14" class="64px">14</option>
				   <option  value="15" class="64px">15</option>
				   <option  value="16" class="64px">16</option>
				   <option  value="17" class="64px">17</option>
				   <option  value="18" class="64px">18</option>
				   <option  value="19" class="64px">19</option>
				   <option  value="20" class="64px">20</option>
			</select></center>
		</td>
	{/if}
</tr>
<tr> </tr>
</tbody>
<tfoot> 
<th colspan="6">   </th>
</tfoot>
</table>
</p>



<div class="clear"></br></div>

<div class="button-container">
	<input type="submit" form='return' name="valid" id="btnreturn" value="{_T string="Return"}"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" name="valid" id="btnsave" value="{_T string="Save"}"/>
</div>

</form>

<div class="clear"></br></div>

<form action="NotesUVs.php" method="post" id='return'>
	
</form>