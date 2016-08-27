<%@ Page Title="" Language="C#" MasterPageFile="~/Pages/MasterPage.Master" AutoEventWireup="true" CodeBehind="StudentsLoginPage.aspx.cs" Inherits="NAPS_E_Voting_App.Pages.StudentsLoginPage" %>
<asp:Content ID="Content1" ContentPlaceHolderID="InstructionsPlaceHolder" runat="server">
    <p>
        Please Log In with the PIN that was given to you:</p>
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="BodyPlaceHolder" runat="server">
    <p>
        <table style="width:100%;">
            <tr>
                <td>PIN:</td>
                <td>
                    <input id="Text1" type="text" name="PINTextbox" /></td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input id="Button1" type="button" value="Log in" name="LoginButton" /></td>
            </tr>
        </table>
    </p>
</asp:Content>
