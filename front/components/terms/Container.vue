<script setup>
const config = useRuntimeConfig().public
</script>
<template>
  <section class="terms-cookies-page mt-5">
    <div class="terms-container">
      <h2 class="title">
        Terms and Conditions
      </h2>
      <p>
        These Terms and Conditions govern the services provided by Travelcorp, LLC (“we,” “us,” “our”) through
        azerbaijanviza.com. By accessing or using our services, you agree to these Terms and Conditions. If you do not
        agree with any part, please refrain from using our services.
      </p>
      <div class="terms">
        <div class="term">
          <h3>1. Independent Service Provider</h3>
          <p> The website azerbaijanviza.com is a private entity and is not owned, operated, sponsored, or endorsed by
            the government of Azerbaijan or any governmental agency. We provide application submission services subject
            to the following Terms and Conditions.</p>
        </div>
        <div class="term">
          <h3>2. Processing Times</h3>
          <ul>
            <li>
              <p><b>Standard service:</b> Typically processed within 3-5 business days.</p>
            </li>
            <li>
              <p><b>Fast Service:</b> Usually processed within 10-12 hours.</p>
            </li>
            <li>
              <p><b>Emergency Service:</b> Typically processed within 3-5 hours.</p>
            </li>
          </ul>
          <p>
            Please note that these times are estimates and cannot be guaranteed. The government of Azerbaijan reserves
            the right to delay, request additional documentation, or deny issuance. We recommend against booking
            non-refundable travel or accommodations until your application is approved.
          </p>
        </div>
        <div class="term">
          <h3>3. Service Fees</h3>
          <ul>
            <li>
              <p>
                <b>Standard Service:</b>
                $69.00 per application ($26.00 government fee + $43.00 service fee).
              </p>
            </li>
            <li>
              <p>
                <b>Fast Service:</b>
                $119.00 per application ($61.00 government fee + $78.00 service fee).
              </p>
            </li>
            <li>
              <p>
                <b>
                  Emergency Service:
                </b>
                $149.00 per application ($61.00 government fee + $88.00 service fee).
              </p>
            </li>
          </ul>
        </div>
        <div class="term">
          <h3>4. Cancellation and Refund Policy</h3>
          <ul>
            <li>
              <p>
                <b>
                  Standard Service:
                </b>
                A full refund may be available if the application has not yet been submitted to the Azerbaijan Embassy
                and is not in the processing stage. Travelcorp, LLC reserves the right to determine refund eligibility
                based on various factors, with the stage of processing being a key consideration.
              </p>
            </li>
            <li>
              <p>
                <b>Fast Service:</b> Non-refundable under any circumstances.
              </p>
            </li>
            <li>
              <p>
                <b>Emergency Service:</b> Non-refundable under any circumstances.
              </p>
            </li>
          </ul>
        </div>
        <div class="term">
          <h3>5. Eligibility</h3>
          <p>
            Documents are granted only to citizens of countries approved by the Ministry of Foreign Affairs of the
            Republic of Azerbaijan and stateless individuals residing in those countries. While Travelcorp, LLC provides
            information in good faith based on data from embassies and consulates, we are not liable for any errors or
            omissions in this information.
          </p>
        </div>
        <div class="term">
          <h3>6. Travel Restrictions</h3>
          <p>
            Issued documents are valid for entry into Azerbaijan only through the following international airports:
            Heydar Aliyev International Airport, Gyandzha Airport, and Nakchivan International Airport. Entry by land is
            not permitted; however, exiting Azerbaijan by land is allowed.
          </p>
        </div>
        <div class="term">
          <h3>7. Service Modifications and Termination</h3>
          <p>
            Travelcorp, LLC reserves the right to modify or discontinue services at any time, with or without notice. We
            are not liable for any changes, suspensions, or terminations of our services.
          </p>
        </div>
        <div class="term">
          <h3>
            8. Third-Party Links and Resources
          </h3>
          <p>
            Our services may include links to third-party websites or resources. Travelcorp, LLC does not control or
            endorse these sites and is not responsible for any loss or damage resulting from their use. Any transactions
            with third parties are solely between you and them, and we are not liable for related issues.
          </p>
        </div>
        <div class="term">
          <h3>9. Consular Fees and Charges</h3>
          <p>
            Fees charged by Travelcorp, LLC exclude any consular fees. Clients are responsible for any additional
            charges from embassies or consulates, which are non-refundable. We reserve the right to adjust our service
            fees at any time, with or without notice.
          </p>
        </div>
        <div class="term">
          <h3>10. Client Responsibility and Dual Citizenship</h3>
          <p>
            Travelcorp, LLC is not liable for actions taken on behalf of clients unless explicitly instructed. Clients
            with dual or multiple citizenships must apply using the document they intend to use for travel. Using a
            different document for the application will invalidate the approval.
          </p>
        </div>
        <div class="term">
          <h3>11. Right to Refuse Service</h3>
          <p>
            Travelcorp, LLC reserves the right to refuse any application at its discretion without providing a reason,
            and to amend these Terms and Conditions as necessary.
          </p>
        </div>
        <div class="term">
          <h3>12. Data Protection and GDPR Compliance</h3>
          <p>
            We comply with GDPR regulations. As outlined in our Privacy Policy, collected data is stored for 85 days and
            shared only with Azerbaijani authorities for processing. You may contact us at
            <a :href="`mailto:${config.mail}`"></a> to request deletion of your data.
          </p>
        </div>
        <div class="term">
          <h3>
            13. Governing Law
          </h3>
          <p>
            These Terms and Conditions are governed by and construed in accordance with the laws of the United States.
          </p>
        </div>
      </div>
    </div>
  </section>
</template>
<script setup lang="ts">
</script>