{*{if $login->isAdmin() || $login->isstaff()}*}
{if $login->isLogged()}
        <h1 class="nojs">{_T string="Passages De Grades"}</h1>
		<ul>
			<li><a href="{$galette_base_path}{$PassagesDeGrades_dir}NotesUVs.php" title="{_T string="Passages De Grades tools"}">{_T string="Notes UVs"}</a></li>
			{*<li>{_T string="My second plugin menu entry"}
			<li>{_T string="My admin plugin menu entry"}</li>*}

		</ul>
        {*<ul>
            <li{if $PAGENAME eq "PassagesDeGrades.php"} class="selected"{/if}><a href="{$galette_base_path}{$galette_galette_Passages_De_Grades_path}PassagesDeGrades.php" title="{_T string="Passages De Grades tools"}">{_T string="Passages De Grades"}</a></li>
        </ul>*}
{/if}
