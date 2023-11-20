<?php

use Latte\Runtime as LR;

/** source: templates/admin.latte */
final class Templated4a952fd30 extends Latte\Runtime\Template
{

	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		echo '<!DOCTYPE html>
<html>
    <head>
        <title>Admin page niagaraServer</title>
        <base href="';
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($baseurl)) /* line 5 */;
		echo '">
        <link rel="stylesheet" href="styles/admin.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <h1>Admin-page </h1>            
        <form method=\'POST\'>  
                <fieldset>
                        <legend>Database</legend>
                        <div class=\'inputContainer\'>
                            <label>                            
                                Db-status:
                            </label>
                            ';
		echo LR\Filters::escapeHtmlText($dbStatusMessage) /* line 19 */;
		echo '
                        </div>


';
		if ($dbStatus) /* line 23 */ {
			echo '                    
                        <div class=\'inputContainer\'>
                            <label>
                                <input name="cleardb" id="cleardb" type="checkbox"> 
                                Clear database - Drop all tables
                            </label>
                        </div>                    

                        <div class=\'inputContainer\'>                    
                            <label>
                                <input name="createdb" id="createdb" type="checkbox"> 
                                Create database structure                            
                            </label>
                        </div>                    


                        <div class=\'inputContainer\'>                    
                            <label>
                                <input name="addtestdata" id="addtestdata" type="checkbox"> 
                                Add test-data to tables
                            </label>
                        </div>                                            

                        <div class=\'inputContainer\'>                    

                            <label>password for admin user:</label>
                            <input name="adminpw" id="adminpw" type="text" value="admin"> 
                        </div>                    

';
		}
		echo '
            </fieldset>
            <fieldset>
                        <legend>Css-styles</legend>
                        <div class=\'inputContainer\'>                                            
                        <label>
                            <input name="generatecss" id="generatecss" type="checkbox"> 
                            Generate css files from scss definitions
                        </label>
                        </div>                                                                    

            </fieldset>                        

            <fieldset>
                        <legend>Htaccess</legend>
                        <div class=\'inputContainer\'>                                                                    
                        <label>
                            <input name="generatehtaccess" id="generatehtaccess" type="checkbox"> 
                            Generate .htaccess files from scss definitions
                        </label>
                        </div>                                                                    
            </fieldset>                        

                
                
                <input type="submit" value="process">  
        </form>  
        <div class=\'message\'>';
		echo LR\Filters::escapeHtmlText($message) /* line 81 */;
		echo '</div>

        <fieldset class=\'sql\'>
            <legend>Reports</legend>

            <h3>EnvironmentSetup report</h3>
';
		foreach ($environmentSetupReport as $entry) /* line 87 */ {
			echo '                <div class=\'reportEntry ';
			echo LR\Filters::escapeHtmlAttr($entry['type']) /* line 88 */;
			echo '\'>
                    <div class=\'reportEntryType\'>';
			echo LR\Filters::escapeHtmlText($entry['type']) /* line 89 */;
			echo '</div>
                    <pre class=\'reportEntryMessage\'>';
			echo LR\Filters::escapeHtmlText($entry['message']) /* line 90 */;
			echo '</pre>
                </div>
';

		}

		echo '
            <h3>DataBaseMaintenance report</h3>
';
		foreach ($dataBaseMaintenanceReport as $entry) /* line 95 */ {
			echo '                <div class=\'reportEntry ';
			echo LR\Filters::escapeHtmlAttr($entry['type']) /* line 96 */;
			echo '\'>
                    <div class=\'reportEntryType\'>';
			echo LR\Filters::escapeHtmlText($entry['type']) /* line 97 */;
			echo '</div>
                    <pre class=\'reportEntryMessage\'>';
			echo LR\Filters::escapeHtmlText($entry['message']) /* line 98 */;
			echo '</pre>
                </div>
';

		}

		echo '

            <h3>TestDataLoader report</h3>
';
		foreach ($testDataLoaderReport as $entry) /* line 104 */ {
			echo '                <div class=\'reportEntry ';
			echo LR\Filters::escapeHtmlAttr($entry['type']) /* line 105 */;
			echo '\'>
                    <div class=\'reportEntryType\'>';
			echo LR\Filters::escapeHtmlText($entry['type']) /* line 106 */;
			echo '</div>
                    <pre class=\'reportEntryMessage\'>';
			echo LR\Filters::escapeHtmlText($entry['message']) /* line 107 */;
			echo '</pre>
                </div>
';

		}

		echo '
        </div>
    </body>
</html>


';
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['entry' => '87, 95, 104'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}
}
