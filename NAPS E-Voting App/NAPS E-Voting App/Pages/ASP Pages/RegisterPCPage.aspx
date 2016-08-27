<%@ Page Title="" Language="C#" MasterPageFile="~/Pages/MasterPage.Master" AutoEventWireup="true" CodeBehind="RegisterPCPage.aspx.cs" Inherits="NAPS_E_Voting_App.Pages.RegisterPCPage" %>

<asp:Content runat="server" ID="InstructionsContent" ContentPlaceHolderID="InstructionsPlaceHolder">

    <p>
    Register this PC. Login with an admin account:</p>

</asp:Content>

<asp:Content runat="server" ID="FeaturedContent" ContentPlaceHolderID="BodyPlaceHolder">

    <p>
        <table style="width:100%;">
            <tr>
                <td>Username:</td>
                <td>
                    <input id="UsernameTextbox" type="text" name="UsernameTextbox" style="column-fill"/></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input id="PasswordTextbox" type="password" name="PasswordTextbox" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input id="Button1" type="button" value="Log in" name="LoginButton" /></td>
            </tr>
        </table>
    </p>

</asp:Content>