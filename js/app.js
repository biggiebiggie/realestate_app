// $("#btnAddAgent").click(function() {
//   var sNewAgentName = $("#txtNewAgentName").val();
//   var sNewAgentEmail = $("#txtNewAgentEmail").val();
//   // Pass the name and email so it can be saved in the file
//   // Get the id for the agent
//   $.ajax({
//     url: "api-create-agent.php", // the end-point
//     method: "POST", // pass via post
//     data: $("form").serialize(), // create the form to be passed
//     dataType: "JSON" // get text and convert it into JSON
//   }).done(function(jData) {
//     console.log(jData.id);
//     var sDivNewAgent = `
//       <div id="${jData.id}" class="agent">
//         <img src="default.png">
//         <input data-update="name" type="text" value="${sNewAgentName}">
//         <input data-update="email" type="text" value="${sNewAgentEmail}">
//       </div>`;
//     $("#agents").prepend(sDivNewAgent);
//   });
// });

$(document).on("blur", ".property_form input", function() {
  // $('.agent input').blur( function(){
  var sPropertyId = $(this).parent().attr("id");
  var sUserId = $(this).parent().attr("data-user");
  var sUpdateKey = $(this).attr("data-update");
  var sNewValue = $(this).val();

  console.log(sPropertyId, sUpdateKey, sNewValue, sUserId);
  $.ajax({
    url: "agent/api-update-property.php",
    method: "POST",
    data: {
      propertyId: sPropertyId,
      id: sUserId,
      key: sUpdateKey,
      value: sNewValue
    }
  }).done(function(jData) {
    $("." + sPropertyId + "." + sUpdateKey).text(sNewValue);
    console.log("property has been updated, " + sUserId + " " + sUpdateKey);
  });
});

function deleteProperty(oBtn, sPropertyId, userId) {
  $(oBtn).parent().parent().parent().remove();

  $.ajax({
    url:
      "apis/api-delete-property.php?id=" + userId + "&property=" + sPropertyId
  })
    .done(function(jData) {
      console.log(jData);
    })
    .fail(function() {
      console.log("fail");
    });
}
