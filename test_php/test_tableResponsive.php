<!DOCTYPE html>
<html>
<head>
<meta charset="BIG5">
<title>Insert title here</title>
<style>
.container {
  display: table; 
  width: 100%; 
  height: 100%; 
}
.row {
  display: table-row; 
}
.left,
.right,
.center {
  display: table-cell; 
  padding: 20px;
}
.left,
.right {
  width: 160px;
  background: Aquamarine;
}
.center {
  background: Pink;
  border-right: solid 20px white;
}
</style>
</head>
<body>
<div class="container">
  <div class="row" style="background-color: cyan">
  <h1>This should be the top banner</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus neque quasi cum illum repellendus quas veniam et quod velit voluptatem. Explicabo aut totam corrupti omnis at vitae possimus odio rem.</p>
  <p>Iste aliquid voluptatum vel rem sunt quo soluta fugit architecto vero obcaecati quis illum molestias reiciendis maxime eveniet. Debitis quibusdam magni explicabo aut labore temporibus magnam quam dolorem dolor est.</p>
  </div>
  <div class="row">
    <!--<div class="left">
      Left
    </div>-->
    <div class="center">
      <h1>Display table, two column layout</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus neque quasi cum illum repellendus quas veniam et quod velit voluptatem. Explicabo aut totam corrupti omnis at vitae possimus odio rem.</p>
      <p>Iste aliquid voluptatum vel rem sunt quo soluta fugit architecto vero obcaecati quis illum molestias reiciendis maxime eveniet. Debitis quibusdam magni explicabo aut labore temporibus magnam quam dolorem dolor est.</p>
      <p>Quos beatae excepturi explicabo cumque reprehenderit optio nesciunt alias iusto molestiae ea porro natus earum eligendi veritatis vitae veniam voluptatibus eum rem ullam repudiandae sint soluta aut dolor sit voluptas.</p>
      <p>Quo dolores minima voluptatum labore reiciendis modi dignissimos itaque dolorem recusandae excepturi sit error officiis repellat laborum ex nihil quis necessitatibus voluptates ratione et id earum minus quasi eveniet nobis.</p>
      <p>Doloribus repellendus explicabo similique tempore maxime magni nostrum dicta ipsum optio dignissimos at porro suscipit ea odio iste doloremque nemo. Consectetur iste laborum quod facere nobis possimus reiciendis beatae veniam.</p>
    </div>
    <div class="right">
      <ul>
        <li>Lorem.</li>
        <li>Deleniti!</li>
        <li>Mollitia.</li>
        <li>Nostrum?</li>
        <li>Laudantium?</li>
        <li>Vitae.</li>
        <li>Voluptates.</li>
      </ul>
    </div>
  </div>
</div>
</body>
</html>
