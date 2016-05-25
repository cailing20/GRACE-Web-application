<form action="action_page.php">
Further Analysis of Coexpression Results:<br><br>
Sort genes by 
<input type="radio" name="corTrend" value="pos" checked>Positive
<input type="radio" name="corTrend" value="neg">Negative
Correlation <br>
<input type="submit" value="Refresh Table">
<input type="submit" value="Download the Full Table"><br><br>
Choose top <input type="number" name="quantity" min="1" max="3000" value=100> genes<br>
Choose gene sets from
<input type="radio" name="setDB" value="kegg" checked>KEGG Pathways
<input type="radio" name="setDB" value="GeneFamily">HGNC Gene Families
<br>
<input type="submit" value="Enrichment Analysis">
</form>


