<%@ Page Title="" Language="C#" MasterPageFile="~/Pages/MasterPage.Master" AutoEventWireup="true" CodeBehind="VotingPage.aspx.cs" Inherits="NAPS_E_Voting_App.Pages.VotingPage" %>
<asp:Content ID="Content1" ContentPlaceHolderID="InstructionsPlaceHolder" runat="server">
    <p>
        Click on a candidate to view full profile, or click on the</p>
    vote button below any candidate to vote for that candidate.
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="BodyPlaceHolder" runat="server">
    <div id="Candidates">
        <fieldset id="President">POST: President<br />
            <img alt="" src="" width="300" height="300" /><br />
            Name:<br />
            Level:<br />
        </fieldset>
        <fieldset id="VicePresident">POST: Vice-President<br />
            <img alt="" height="300" src="" width="300" /><br />
            Name:<br />
            Level:<br />
        </fieldset>
        <fieldset id="GeneralSecretary">POST: General Secretary<br />
            <img alt="" height="300" src="" width="300" /><br />
            Name:<br />
            Level:<br />
        </fieldset>
        <fieldset id="AGS">POST: Assistant General Secretary<br />
            <img alt="" height="300" src="" width="300" /><br />
            Name:<br />
            Level:<br />
        </fieldset>
        <fieldset id="PRO">POST: Public Relations Officer<br />
            <img alt="" height="300" src="" width="300" /><br />
            Name:<br />
            Level:<br />
        </fieldset>
        <fieldset id="SportsDirector">POST: Sports Director<br />
            <img alt="" height="300" src="" width="300" /><br />
            Name:<br />
            Level:<br />
        </fieldset>
        <fieldset id="SocialDirector">POST: Social Director<br />
            <img alt="" height="300" src="" width="300" /><br />
            Name:<br />
            Level:<br />
        </fieldset>
        <fieldset id="FinancialSecretary">POST: Financial Secretary<br />
            <img alt="" height="300" src="" width="300" /><br />
            Name:<br />
            Level:<br />
        </fieldset>
    </div>
</asp:Content>
