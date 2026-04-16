import BreedComp from "@/components/breedComp";
import Calculator from "@/components/calculator";
import MetaTag from "@/components/meta_tag";
import TitleCover from "@/components/title_cover";
import React from "react";
import axios from "axios";
import { getGlobalData } from "@/lib/globalData";

export const getStaticProps = async () => {
  try {
    const globalData = await getGlobalData();
    // Fetch Meta Data
    const metaRes = await fetch(
      `${process.env.NEXT_PUBLIC_SERVER_API}/api/meta/get-all`
    );
    const metaData = await metaRes.json();
    const meta = metaData.find((item) => item.page === "calculator");

    // Fetch calculator data
    const calcRes = await axios.get(
      `${process.env.NEXT_PUBLIC_SERVER_API}/api/calculator/get-all`
    );
    const calculatorData = calcRes.data;

    // Note: Removed view counter API call since it should not run during static generation
    // View counting should happen client-side or through a separate mechanism

    return {
      props: {
        meta: meta,
        calculatorData: calculatorData || [],
        globalData: globalData,
      },
      revalidate: 60, // Revalidate every 60 seconds (ISR)
    };
  } catch (error) {
    console.error(error);
    const globalData = await getGlobalData();
    return {
      props: {
        meta: null,
        calculatorData: [],
        globalData: globalData,
      },
      revalidate: 60,
    };
  }
};
const CalculatorPage = ({ meta, calculatorData }) => {
  return (
    <>
      <MetaTag
        title={meta?.title || " Court Fee Calculator of Nepal | Developed By Bhandari Law and Partners"}
        keywords={meta?.keywords || "Law Firm in Nepal : Court Fee Calculator of Nepal"}
        imgUrl={`${process.env.NEXT_PUBLIC_SERVER_API}/upload/${meta?.imgUrl || "default.jpg"
          }`}
        canonicalUrl={`${process.env.NEXT_PUBLIC_CLIENT_API}/calculator`}
        description={meta?.description || "Court Fee Calculator of Nepal"}
      />
      <BreedComp
        image="https://images.unsplash.com/photo-1596122440216-ba42e5a3fb09?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=435&q=80"
        sub="calculator"
      />
      <TitleCover title="COURT FEE CALCULATOR OF NEPAL" />
      <div className=" mx-20 mb-20 mt-10 p-10 rounded-md text-blue-900 shadow-xl max-md:mx-6 max-md:p-5">
        <Calculator />
      </div>

      <div className="rounded-md text-blue-900 mx-10 p-10 max-md:mx-0 max-md:p-6">
        {calculatorData?.map((item, i) => (
          <div key={item.id} className="">
            <div className="text-3xl  mb-3">{item.title}</div>
            <div className="text-black" dangerouslySetInnerHTML={{ __html: item.description }}>
            </div>
          </div>
        ))}

      </div>

      {/* <div className=" mx-10 px-10 pb-10 rounded-md text-blue-900 ">
      <div className="text-3xl  mb-3">
         How Court Fee is Determined? 
        </div>
        <div class= "mt-8 mb-5 text-black">The rate of court fee is calculated based on the following criteria as determined by the Section 69 of Chapter of Provisions Relating to Court Fees of National Civil Procedure (Code) Act, 2017 of Nepal.</div>
       
        <div className="mt-4 grid grid-cols-2 w-[80%] max-md:w-full text-black">
          <div className="border-b px-6 py-3 max-md:px-3">Amount</div>
          <div className="border-b px-6 py-3 max-md:px-3">Court Fee</div>
          <div className="border-b px-6 py-3 max-md:px-3">a. Upto 25,000</div>
          <div className="border-b px-6 py-3 max-md:px-3">
            Rs. 500/- (Five hundred rupees only)
          </div>
          <div className="border-b px-6 py-3 max-md:px-3">
            b. 25,001 to 50,000
          </div>
          <div className="border-b px-6 py-3 max-md:px-3">5% of the amount</div>
          <div className="border-b px-6 py-3 max-md:px-3">
            c. 50,001 to 1,00,000
          </div>
          <div className="border-b px-6 py-3 max-md:px-3">
            3. 5 % of the amount
          </div>
          <div className="border-b px-6 py-3 max-md:px-3">
            d. 1,00,001 to 5,00,000
          </div>
          <div className="border-b px-6 py-3 max-md:px-3">2% of the amount</div>
          <div className="border-b px-6 py-3 max-md:px-3">
            e. 5,00,001 to 25,00,000
          </div>
          <div className="border-b px-6 py-3 max-md:px-3">
            1.5% of the amount
          </div>
          <div className="border-b px-6 py-3 max-md:px-3">
            f. More than 25,00,000
          </div>
          <div className="border-b px-6 py-3 max-md:px-3">1% of the amount</div>
        </div>
      </div> */}
    </>
  );
};

export default CalculatorPage;



import React, { useState } from "react";

const Calculator = () => {
  const [amount, setAmount] = useState("");
  const [lawFee, setLawFee] = useState(null);
  const twentyfivethousand = 25000;
  const fiftythousand = 50000;
  const onelakh = 100000;
  const fivelakh = 500000;
  const twentyfivelakh = 2500000;
  const [calculationBreakdown, setCalculationBreakdown] = useState([]);

  const handleAmountChange = (e) => {
    setAmount(e.target.value);
    setLawFee("");
  };
  const calculateLawFee = () => {
    const amountValue = parseFloat(amount);
    if (isNaN(amountValue) || amountValue <= 0) {
      alert("Please enter a valid amount.");
      return;
    }
    let fee = 0;
    let breakdown = [];

    if (amountValue <= twentyfivethousand) {
      fee = 500;
      breakdown = [{ range: "Upto 25,000", fee: 500 }];
    } else if (amountValue <= fiftythousand) {
      const amt = amountValue - twentyfivethousand;
      const step1Fee = 500;
      const step2Fee = 0.05 * amt;
      fee = step1Fee + step2Fee;

      breakdown = [
        { range: "Upto 25,000", fee: step1Fee },
        { range: `From 25,001 to 50,000 : 5% of ${amt}`, fee: step2Fee },
      ];
    } else if (amountValue <= onelakh) {
      const amt = amountValue - fiftythousand;
      const step1Fee = 500;
      const step2Fee = 0.05 * twentyfivethousand;
      const step3Fee = 0.035 * amt;
      fee = step1Fee + step2Fee + step3Fee;

      breakdown = [
        { range: "Upto 25,000", fee: step1Fee },
        { range: `From 25,001 to 50,000 : 5% of 25,000`, fee: step2Fee },
        { range: `From 50,001 to 1,00,000 : 3.5 % of ${amt}`, fee: step3Fee },
      ];
    } else if (amountValue <= fivelakh) {
      const amt = amountValue - onelakh;
      const step1Fee = 500;
      const step2Fee = 0.05 * twentyfivethousand;
      const step3Fee = 0.035 * fiftythousand;
      const step4Fee = 0.02 * amt;
      fee = step1Fee + step2Fee + step3Fee + step4Fee;

      breakdown = [
        { range: "Upto 25,000", fee: step1Fee },
        {
          range: `From 25,001 to 50,000 : 5% of ${twentyfivethousand}`,
          fee: step2Fee,
        },
        {
          range: `From 50,001 to 1,00,000 : 3.5% of ${fiftythousand}`,
          fee: step3Fee,
        },
        { range: `From 1,00,001 to 5,00,000 : 2 % of ${amt}`, fee: step4Fee },
      ];
    } else if (amountValue <= twentyfivelakh) {
      const amt = amountValue - fivelakh;
      const step1Fee = 500;
      const step2Fee = 0.05 * twentyfivethousand;
      const step3Fee = 0.035 * fiftythousand;
      const step4Fee = 0.02 * 400000;
      const step5Fee = 0.015 * amt;
      fee = step1Fee + step2Fee + step3Fee + step4Fee + step5Fee;

      breakdown = [
        { range: "Upto 25,000", fee: step1Fee },
        {
          range: `From 25,001 to 50,000 : 5% of ${twentyfivethousand}`,
          fee: step2Fee,
        },
        {
          range: `From 50,001 to 1,00,000 : 3.5 % of ${fiftythousand}`,
          fee: step3Fee,
        },
        { range: `From 1,00,001 to 5,00,000 : 2 % of 4,00,000`, fee: step4Fee },
        {
          range: `From 5,00,001 to 25,00,000 : 1.5 % of ${amt}`,
          fee: step5Fee,
        },
      ];
    } else {
      const amt = amountValue - twentyfivelakh;
      const step1Fee = 500;
      const step2Fee = 0.05 * twentyfivethousand;
      const step3Fee = 0.035 * fiftythousand;
      const step4Fee = 0.02 * 400000;
      const step5Fee = 0.015 * 2000000;
      const step6Fee = 0.01 * amt;
      fee = step1Fee + step2Fee + step3Fee + step4Fee + step5Fee + step6Fee;

      breakdown = [
        { range: "Upto 25,000", fee: step1Fee },
        {
          range: `From 25,001 to 50,000 : 5% of ${twentyfivethousand}`,
          fee: step2Fee,
        },
        {
          range: `From 50,001 to 1,00,000 : 3.5 % of ${fiftythousand}`,
          fee: step3Fee,
        },
        { range: `From 1,00,001 to 5,00,000 : 2 % of 4,00,000`, fee: step4Fee },
        {
          range: `From 5,00,001 to 25,00,000 : 1.5 % of 20,00,000`,
          fee: step5Fee,
        },
        { range: `Above 25,00,001  : 1 % of ${amt}`, fee: step6Fee },
      ];
    }
    setLawFee(fee);
    setCalculationBreakdown(breakdown);
  };

  return (
    <>
      <div className="grid grid-cols-3 ">
        <div className="col-span-2 max-md:col-span-3">
          <div className="text-4xl"> Calculate your Court Fee</div>
          <div className="mt-5 ">
            <label htmlFor="amount">Enter your amount :</label>
            <div className="flex my-1 gap-7  max-md:flex-col">
              <input
                type="number"
                required
                placeholder="20000"
                id="amount"
                value={amount}
                onChange={handleAmountChange}
                className="font-sans py-2 w-[70%] max-md:w-full px-2 rounded shadow focus:shadow-lg border border-gray-300 focus:border-transparent focus:outline-none"
              />
              <button
                onClick={calculateLawFee}
                className="hover:text-[white] bg-[#2b4c65] rounded px-4 py-1 text-[#fff] hover:border-2 duration-150 transition-all border-2 hover:border-[white] border-[#2b4c65] lg:bottom-12 flex justify-center text-lg w-max max-md:w-full"
              >
                Calculate
              </button>
            </div>
          </div>
          <div className="mt-5 flex w-full gap-3 max-md:flex-col">
            <label htmlFor="amount" className="pt-2">
              Court Fee to be paid before court:
            </label>
            <div className=" max-md:w-[100%] w-[290px] max-md:mt-2">
              {!lawFee && (
                <input
                  type="number"
                  required
                  placeholder="Calcuated Amount"
                  id="amount"
                  value=""
                  className="font-sans py-2 px-2 w-full rounded shadow focus:shadow-lg border border-gray-300 focus:border-transparent focus:outline-none"
                />
              )}
              {lawFee && (
                <input
                  type="number"
                  required
                  placeholder="Calcuated Amount"
                  id="amount"
                  value={lawFee?.toFixed(2)}
                  className="font-sans py-2 px-2 w-full rounded shadow focus:shadow-lg border border-gray-300 focus:border-transparent focus:outline-none"
                />
              )}
            </div>
          </div>
        </div>
        <div className="max-md:hidden">
          <img
            src="/img/calculator.jpg"
            className="aspect-video w-full object-cover rounded-md"
            alt="Best law firm in Nepal"
          />
        </div>
      </div>
      <div className="mt-6">
        {!lawFee && (
             <div >
             <div className=" text-xl">Division of Fee :</div>
             {/* <p className="mt-3 text-xl">Calculation Display Table :</p> */}
             {/* <p className="mt-3 text-xl">Example :</p> */}
             <table className="mt-3 w-[65%] max-md:w-full ">
               <thead>
                 <tr>
                   <th>Range</th>
                   <th>Fee</th>
                 </tr>
               </thead>
               <tbody>
                   <tr>
                     <td>Upto 25,000 </td>
                     <td>Rs..........</td>
                   </tr>
                   <tr>
                     <td>25,001 to 50,000</td>
                     <td>Rs..........</td>
                   </tr>
                   <tr>
                     <td>50,001 to 1,00,000</td>
                     <td>Rs..........</td>
                   </tr>
                  <tr><td>Total</td>
                  <td>Rs..........</td>
                 </tr>
               
               </tbody>
             </table>
              
           </div>
        )

        }
                </div>
      <div className="mt-10">
        {lawFee  && (
          <div >
            <div className="mt-3 text-xl">Division of Fee :</div>

            <p className="mt-3 text-xl">Calculation Display Table :</p>
            
            <table className="mt-3 w-[65%] max-md:w-full ">
              <thead>
                <tr>
                  <th>Range</th>
                  <th>Fee</th>
                </tr>
              </thead>
              <tbody>
                {calculationBreakdown.map((item, index) => (
                  <tr key={index}>
                    <td>{item.range}</td>
                    <td>Rs.{item.fee.toFixed(2)}</td>
                  </tr>
                ))}
               
                 <tr><td>Total</td>
                <td> Rs.{lawFee.toFixed(2)}</td></tr>
              
              </tbody>
            </table>
             
          </div>
        )}
      </div>
   
    </>
  );
};

export default Calculator;
