<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="MasterPage1.aspx.cs" Inherits="NAPS_E_Voting_App.MasterPage1" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
    <div id="container" style="width:1000px;">
    
        <div id="header" style="text-align:center">
            <h1>Welcome to the NAPS E-Voting Platform<img alt="" src="../Resources/NAPS%20logo%2064%20x%2064.bmp" /></h1>
        </div>

        <div id="logo" style="background-color:grey;height:300px;width:403px;float:right">
            <img alt="" src="../Resources/NAPS%20logo.jpg" />
        </div>
        
        <div id="instructions" style="background-color:grey;height:300px;width:597px;float:left"> </div>

        <div id="body"></div>

        <div id="footer" style="background-color:skyblue;width:1000px;text-align:center;">
            copyright Osmosis & Tolu
        </div>
    
    </div>
    </form>
</body>
</html>
