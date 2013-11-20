I. Make sure your j1.5 site is updated to 1.5.26 and its database is not hacked

II. Install redMIGRATOR component into j2.5.x or j3.x site

III. We have two methods in redMIGRATOR. Use can choose one of them for migrate.

* Restful: 
  Note: + Throught webservice
        + Slow
        + Can be restricted by ISP
        + No need database credentials, only need super user account
  
  1. Install plugin for j1.5 site (redMIGRATOR - System plugin)
  2. Enable this plugin and input key for client site
  3. Disable another system plugins (except joomla system plugins) such as jupgrade, ... if they exist in the site.
  4. Input config informations in j2.5.x or j3.x site:
        + Migation method in global tab: RESTful
        + Hostname, Username, Password, Security key (the you inputed in j1.5 site) in RESTful tab

* Database:
  Note: + Fast
        + Need database credentials

  1. Input config informations in j2.5.x or j3.x site:
    + Migation method in global tab: Database
    + Database driver, Hostname, Username, Password, Database name, Prefix in Database tab