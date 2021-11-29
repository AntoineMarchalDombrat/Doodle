<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
      <div>
         <h1 > Inscription </h1>
         <br><br><br>
         <form method="POST">
            <table>

            <tr>
               <td>
                  <label> Login : </label>
               </td>
               <td>
                  <input type="text" placeholder="Votre login" name="login" maxlength="20" >
               </td>
            </tr>

            <tr>
               <td>
                  <label> Mot de passe : </label>
               </td>
               <td>
                  <input type="password" placeholder="Votre mdp" name="mdp" maxlength="200">
               </td>
            </tr>

            <tr>
               <td>
                  <label> Mail : </label>
               </td>
               <td>
                  <input type="email" placeholder="Votre Mail" name="mail" maxlength="50">
               </td>
            </tr>

            <tr>
               <td>
                  <label> Nom : </label>
               </td>
               <td>
                  <input type="text" placeholder="Votre nom" name="nom" maxlength="20">
               </td>
            </tr>

            <tr>
               <td>
                  <label> Prénom : </label>
               </td>
               <td>
                  <input type="text" placeholder="Votre prénom" name="prenom" maxlength="20">
               </td>
            </tr>

            <tr>

            	<td></td>
            	<td>
            		<br>
            	<input type="submit" value="je m'inscris">
        		</td>
        	</tr>
            </table>
         </form>
        </div>
      </body>
