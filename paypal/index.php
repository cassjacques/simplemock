<div id="paypal-button-container-P-42S95695UD874062DMBNZY4Y"></div>
<script src="https://www.paypal.com/sdk/js?client-id=AcTF_4OvewZfyMqDQ_J7cMygZB15rgkqXb_GQaGd4eWFfDLLra0BmWrGAZiJ1MqDHJw4jfAYKWxtQN1o&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script> 
<script>
  paypal.Buttons({
      style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-42S95695UD874062DMBNZY4Y'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-42S95695UD874062DMBNZY4Y'); // Renders the PayPal button
</script>