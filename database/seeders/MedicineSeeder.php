<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $medicines = [

            // ===== Pain & Fever =====
            ['Napa', 'Paracetamol', 'Square', 'Tablet', 'BD1001', 1.50, 2.00, 200],
            ['Ace', 'Paracetamol', 'Beximco', 'Tablet', 'BD1002', 1.40, 2.00, 200],
            ['Napa Extra', 'Paracetamol + Caffeine', 'Square', 'Tablet', 'BD1003', 2.00, 3.00, 150],
            ['Calpol', 'Paracetamol', 'GlaxoSmithKline', 'Syrup', 'BD1004', 40.00, 55.00, 100],
            ['Fastdol', 'Paracetamol', 'Incepta', 'Tablet', 'BD1005', 1.60, 2.20, 180],

            // ===== Acid / Gastric =====
            ['Seclo', 'Omeprazole', 'Square', 'Capsule', 'BD1010', 4.00, 6.00, 200],
            ['Sergel', 'Esomeprazole', 'Healthcare', 'Capsule', 'BD1011', 5.50, 8.00, 180],
            ['Nexum', 'Esomeprazole', 'Beximco', 'Capsule', 'BD1012', 6.00, 9.00, 150],
            ['Pantonix', 'Pantoprazole', 'Square', 'Tablet', 'BD1013', 4.50, 6.50, 160],
            ['Rabe', 'Rabeprazole', 'Square', 'Tablet', 'BD1014', 6.00, 8.50, 140],

            // ===== Antibiotics =====
            ['Zimax', 'Azithromycin', 'Square', 'Tablet', 'BD1020', 25.00, 35.00, 100],
            ['Azithral', 'Azithromycin', 'IPCA', 'Tablet', 'BD1021', 24.00, 34.00, 90],
            ['Ciprocin', 'Ciprofloxacin', 'Square', 'Tablet', 'BD1022', 3.50, 5.00, 120],
            ['Flagyl', 'Metronidazole', 'Sanofi', 'Tablet', 'BD1023', 2.00, 3.00, 200],
            ['Amoxiclav', 'Amoxicillin + Clavulanic Acid', 'Square', 'Tablet', 'BD1024', 18.00, 25.00, 110],

            // ===== Allergy =====
            ['Alatrol', 'Loratadine', 'Square', 'Tablet', 'BD1030', 1.50, 2.20, 200],
            ['Fexo', 'Fexofenadine', 'Renata', 'Tablet', 'BD1031', 3.00, 4.50, 150],
            ['Histacin', 'Antihistamine', 'Square', 'Tablet', 'BD1032', 1.80, 2.50, 220],

            // ===== Vitamins =====
            ['Ceevit', 'Vitamin C', 'Square', 'Tablet', 'BD1040', 1.20, 2.00, 300],
            ['Becosules', 'Vitamin B Complex', 'Abbott', 'Capsule', 'BD1041', 5.00, 7.50, 180],
            ['Zincovit', 'Zinc + Vitamins', 'IPCA', 'Tablet', 'BD1042', 3.00, 4.50, 250],
            ['Calcium Sandoz', 'Calcium', 'Novartis', 'Tablet', 'BD1043', 3.50, 5.00, 200],

            // ===== Syrups =====
            ['Napa Syrup', 'Paracetamol', 'Square', 'Syrup', 'BD1050', 35.00, 50.00, 120],
            ['Ace Syrup', 'Paracetamol', 'Beximco', 'Syrup', 'BD1051', 32.00, 48.00, 100],
            ['Cough Syrup', 'Ambroxol', 'Square', 'Syrup', 'BD1052', 45.00, 65.00, 90],

            // ===== Diabetes =====
            ['Glycomet', 'Metformin', 'USV', 'Tablet', 'BD1060', 2.50, 3.50, 200],
            ['Insulin Actrapid', 'Insulin', 'Novo Nordisk', 'Injection', 'BD1061', 350.00, 500.00, 50],

            // ===== Blood Pressure / Heart =====
            ['Amlodipine', 'Amlodipine', 'Square', 'Tablet', 'BD2001', 2.50, 3.50, 150],
            ['Angilock', 'Losartan', 'Square', 'Tablet', 'BD2002', 4.00, 6.00, 140],
            ['Tenormin', 'Atenolol', 'AstraZeneca', 'Tablet', 'BD2003', 3.50, 5.00, 130],
            ['Carvedilol', 'Carvedilol', 'Renata', 'Tablet', 'BD2004', 5.00, 7.00, 120],
            ['Inderal', 'Propranolol', 'Square', 'Tablet', 'BD2005', 2.80, 4.00, 110],

                        // ===== Respiratory / Cough / Cold =====
            ['Monas', 'Montelukast', 'Square', 'Tablet', 'BD3001', 6.00, 9.00, 150],
            ['Montair', 'Montelukast', 'Sun Pharma', 'Tablet', 'BD3002', 6.50, 9.50, 140],
            ['Telfast', 'Fexofenadine', 'Sanofi', 'Tablet', 'BD3003', 4.00, 6.00, 160],
            ['Ventolin', 'Salbutamol', 'GSK', 'Inhaler', 'BD3004', 250.00, 350.00, 60],
            ['Asthalin', 'Salbutamol', 'Cipla', 'Inhaler', 'BD3005', 220.00, 320.00, 70],

            // ===== Antibiotics (Extra Common BD Use) =====
            ['Ornidazole', 'Ornidazole', 'Square', 'Tablet', 'BD3010', 5.00, 7.50, 130],
            ['Tinidazole', 'Tinidazole', 'Renata', 'Tablet', 'BD3011', 4.50, 6.50, 140],
            ['Clindamycin', 'Clindamycin', 'Square', 'Capsule', 'BD3012', 12.00, 18.00, 90],
            ['Doxycycline', 'Doxycycline', 'Incepta', 'Capsule', 'BD3013', 8.00, 12.00, 120],
            ['Cefurox', 'Cefuroxime', 'GSK', 'Tablet', 'BD3014', 20.00, 30.00, 80],

            // ===== Pain Injection / Emergency =====
            ['Ketorolac', 'Ketorolac', 'Square', 'Injection', 'BD3020', 25.00, 40.00, 50],
            ['Diclofenac Inj', 'Diclofenac', 'Novartis', 'Injection', 'BD3021', 20.00, 35.00, 60],
            ['Tramadol', 'Tramadol', 'Square', 'Capsule', 'BD3022', 10.00, 15.00, 110],

            // ===== Liver / Gastro =====
            ['Hepamerz', 'L-Ornithine L-Aspartate', 'Abbott', 'Syrup', 'BD3030', 120.00, 180.00, 40],
            ['Ursocol', 'Ursodeoxycholic Acid', 'Sun Pharma', 'Tablet', 'BD3031', 15.00, 22.00, 90],
            ['Domperidone', 'Domperidone', 'Square', 'Tablet', 'BD3032', 2.50, 3.50, 200],

            // ===== Pediatric =====
            ['Peditral', 'ORS Pediatric', 'Square', 'Sachet', 'BD3040', 6.00, 9.00, 300],
            ['Zinc Baby', 'Zinc Sulphate', 'Renata', 'Tablet', 'BD3041', 2.00, 3.00, 250],
            ['Calpol Baby', 'Paracetamol', 'GSK', 'Syrup', 'BD3042', 45.00, 65.00, 120],

            // ===== Hormonal / Thyroid =====
            ['Thyronorm', 'Levothyroxine', 'Abbott', 'Tablet', 'BD3050', 4.00, 6.00, 140],
            ['Euthyrox', 'Levothyroxine', 'Merck', 'Tablet', 'BD3051', 4.50, 6.50, 130],
            ['Prednisolone', 'Prednisolone', 'Square', 'Tablet', 'BD3052', 2.50, 3.50, 160],

            // ===== Neurology / Mental Health =====
            ['Nexito', 'Escitalopram', 'Sun Pharma', 'Tablet', 'BD3060', 8.00, 12.00, 90],
            ['Tryptanol', 'Amitriptyline', 'Square', 'Tablet', 'BD3061', 3.00, 5.00, 120],
            ['Rivotril', 'Clonazepam', 'Roche', 'Tablet', 'BD3062', 10.00, 15.00, 80],

            // ===== Skin / Anti-fungal =====
            ['Fluconazole', 'Fluconazole', 'Square', 'Capsule', 'BD3070', 10.00, 15.00, 140],
            ['Itraconazole', 'Itraconazole', 'Renata', 'Capsule', 'BD3071', 12.00, 18.00, 130],
            ['Candid Cream', 'Clotrimazole', 'GSK', 'Cream', 'BD3072', 25.00, 40.00, 100],

            // ===== Cardiac Advanced =====
            ['Clopidogrel', 'Clopidogrel', 'Square', 'Tablet', 'BD3080', 12.00, 18.00, 150],
            ['Ecosprin', 'Aspirin', 'USV', 'Tablet', 'BD3081', 3.00, 5.00, 200],
            ['Atorvastatin', 'Atorvastatin', 'Square', 'Tablet', 'BD3082', 6.00, 9.00, 180],

            // ===== Common Pharmacy Essentials =====
            ['Savlon', 'Antiseptic', 'ACI', 'Liquid', 'BD3090', 35.00, 55.00, 100],
            ['Dettol', 'Chloroxylenol', 'Reckitt', 'Liquid', 'BD3091', 40.00, 60.00, 110],
            ['Burnol', 'Antiseptic Cream', 'Square', 'Cream', 'BD3092', 25.00, 35.00, 120],
            ['Vicks Vaporub', 'Menthol', 'P&G', 'Ointment', 'BD3093', 45.00, 65.00, 150],
            ['ORS Salt', 'Oral Rehydration Salt', 'Square', 'Sachet', 'BD3094', 5.00, 7.00, 400],

                        // ===== Respiratory / Asthma =====
            ['Seretide', 'Salmeterol + Fluticasone', 'GSK', 'Inhaler', 'BD4001', 450.00, 650.00, 50],
            ['Foracort', 'Budesonide + Formoterol', 'Cipla', 'Inhaler', 'BD4002', 400.00, 600.00, 60],
            ['Budesonide Respules', 'Budesonide', 'Square', 'Nebulizer', 'BD4003', 300.00, 450.00, 70],
            ['Salbutamol Neb', 'Salbutamol', 'Renata', 'Nebulizer', 'BD4004', 250.00, 380.00, 80],

            // ===== Strong Antibiotics =====
            ['Meronem', 'Meropenem', 'AstraZeneca', 'Injection', 'BD4010', 1200.00, 1800.00, 20],
            ['Tazopen', 'Piperacillin + Tazobactam', 'Square', 'Injection', 'BD4011', 900.00, 1300.00, 25],
            ['Vancomycin', 'Vancomycin', 'Healthcare', 'Injection', 'BD4012', 800.00, 1200.00, 30],
            ['Imipenem', 'Imipenem', 'Beximco', 'Injection', 'BD4013', 1100.00, 1600.00, 20],

            // ===== Pain / Strong Analgesic =====
            ['Tramadol SR', 'Tramadol', 'Square', 'Capsule', 'BD4020', 12.00, 18.00, 100],
            ['Morphine', 'Morphine Sulfate', 'GSK', 'Injection', 'BD4021', 150.00, 220.00, 30],

            // ===== Diabetes Advanced =====
            ['Trajenta', 'Linagliptin', 'Boehringer', 'Tablet', 'BD4030', 45.00, 65.00, 80],
            ['Galvus', 'Vildagliptin', 'Novartis', 'Tablet', 'BD4031', 40.00, 60.00, 90],
            ['Januvia', 'Sitagliptin', 'Merck', 'Tablet', 'BD4032', 55.00, 80.00, 70],

            // ===== Cardiac Advanced =====
            ['Plavix', 'Clopidogrel', 'Sanofi', 'Tablet', 'BD4040', 14.00, 20.00, 120],
            ['Rosuvastatin', 'Rosuvastatin', 'Square', 'Tablet', 'BD4041', 8.00, 12.00, 150],
            ['Crestor', 'Rosuvastatin', 'AstraZeneca', 'Tablet', 'BD4042', 10.00, 15.00, 140],

            // ===== Neurology =====
            ['Gabapentin', 'Gabapentin', 'Incepta', 'Capsule', 'BD4050', 8.00, 12.00, 120],
            ['Pregabalin', 'Pregabalin', 'Square', 'Capsule', 'BD4051', 12.00, 18.00, 110],
            ['Seroquel', 'Quetiapine', 'AstraZeneca', 'Tablet', 'BD4052', 18.00, 25.00, 90],

            // ===== Gastro Advanced =====
            ['Esomeprazole IV', 'Esomeprazole', 'Healthcare', 'Injection', 'BD4060', 250.00, 350.00, 40],
            ['Pantocid IV', 'Pantoprazole', 'Sun Pharma', 'Injection', 'BD4061', 200.00, 300.00, 50],

            // ===== Liver / Digestive =====
            ['Liv-52', 'Herbal Liver Support', 'Himalaya', 'Tablet', 'BD4070', 6.00, 9.00, 150],
            ['Heptral', 'Ademetionine', 'Abbott', 'Tablet', 'BD4071', 80.00, 120.00, 60],

            // ===== Eye / ENT =====
            ['Tobramycin Eye Drop', 'Tobramycin', 'Alcon', 'Drops', 'BD4080', 90.00, 130.00, 100],
            ['Ofloxacin Eye Drop', 'Ofloxacin', 'Square', 'Drops', 'BD4081', 70.00, 100.00, 120],

            // ===== Skin / Dermatology =====
            ['Econazole Cream', 'Econazole', 'Renata', 'Cream', 'BD4090', 30.00, 45.00, 140],
            ['Ketoconazole Cream', 'Ketoconazole', 'Square', 'Cream', 'BD4091', 25.00, 40.00, 150],

            // ===== Hormone / Special =====
            ['Duphaston', 'Dydrogesterone', 'Abbott', 'Tablet', 'BD4100', 35.00, 50.00, 100],
            ['Progesterone', 'Progesterone', 'Incepta', 'Capsule', 'BD4101', 30.00, 45.00, 90],

            // ===== Emergency / ICU =====
            ['Adrenaline', 'Epinephrine', 'Healthcare', 'Injection', 'BD4110', 150.00, 220.00, 30],
            ['Atropine', 'Atropine Sulfate', 'Square', 'Injection', 'BD4111', 120.00, 180.00, 40],
            ['Dopamine', 'Dopamine', 'Beximco', 'Injection', 'BD4112', 200.00, 300.00, 35],

            // ===== Common Pharmacy Items =====
            ['Hydrogen Peroxide', 'Antiseptic', 'ACI', 'Liquid', 'BD4120', 25.00, 40.00, 200],
            ['Spirit', 'Ethanol', 'Square', 'Liquid', 'BD4121', 30.00, 50.00, 180],
            ['Cotton Roll', 'Medical Cotton', 'Local', 'Accessory', 'BD4122', 20.00, 30.00, 300],
            ['Bandage', 'Medical Bandage', 'Local', 'Accessory', 'BD4123', 15.00, 25.00, 250],
            ['Surgical Mask', 'Mask', 'Local', 'Accessory', 'BD4124', 5.00, 10.00, 500],

                // ===== Additional Pain & Fever =====
    ['Napa Rapid', 'Paracetamol', 'Square', 'Tablet', 'BD3100', 2.00, 3.00],
    ['Ace Plus', 'Paracetamol + Caffeine', 'Beximco', 'Tablet', 'BD3101', 2.50, 3.50],
    ['Pamol', 'Paracetamol', 'Incepta', 'Tablet', 'BD3102', 1.80, 2.50],
    ['Tempra', 'Paracetamol', 'GSK', 'Syrup', 'BD3103', 45.00, 65.00],

    // ===== Strong Antibiotics =====
    ['Clavam', 'Amoxicillin + Clavulanic Acid', 'Square', 'Tablet', 'BD3110', 22.00, 32.00],
    ['Cefix', 'Cefixime', 'Renata', 'Tablet', 'BD3111', 18.00, 26.00],
    ['Ceftum', 'Cefuroxime', 'GSK', 'Tablet', 'BD3112', 20.00, 30.00],
    ['Zithromax', 'Azithromycin', 'Pfizer', 'Tablet', 'BD3113', 28.00, 40.00],
    ['Oracef', 'Cefixime', 'Incepta', 'Capsule', 'BD3114', 16.00, 24.00],

    // ===== Gastric / Acid =====
    ['Esoral', 'Esomeprazole', 'Square', 'Capsule', 'BD3120', 6.00, 9.00],
    ['Omastin', 'Omeprazole', 'Incepta', 'Capsule', 'BD3121', 4.50, 6.50],
    ['Pantid', 'Pantoprazole', 'Square', 'Tablet', 'BD3122', 4.00, 6.00],
    ['Rabifast', 'Rabeprazole', 'Renata', 'Tablet', 'BD3123', 6.50, 9.50],

    // ===== Diabetes =====
    ['Diabetrol', 'Gliclazide', 'Square', 'Tablet', 'BD3130', 3.50, 5.00],
    ['Metfo XR', 'Metformin XR', 'Beximco', 'Tablet', 'BD3131', 3.00, 4.50],
    ['Glucophage', 'Metformin', 'Merck', 'Tablet', 'BD3132', 2.80, 4.00],

    // ===== Heart / BP =====
    ['Amlovas', 'Amlodipine', 'Square', 'Tablet', 'BD3140', 2.50, 3.50],
    ['Losacard', 'Losartan', 'Incepta', 'Tablet', 'BD3141', 4.50, 6.50],
    ['Betaloc', 'Metoprolol', 'AstraZeneca', 'Tablet', 'BD3142', 5.00, 7.00],
    ['Norvasc', 'Amlodipine', 'Pfizer', 'Tablet', 'BD3143', 3.50, 5.00],

    // ===== Allergy =====
    ['Alledryl', 'Diphenhydramine', 'Square', 'Tablet', 'BD3150', 2.00, 3.00],
    ['Histal', 'Antihistamine', 'Renata', 'Tablet', 'BD3151', 1.80, 2.50],
    ['Levocet', 'Levocetirizine', 'Square', 'Tablet', 'BD3152', 2.50, 3.50],

    // ===== Vitamins / Supplements =====
    ['Revital H', 'Multivitamin', 'Ranbaxy', 'Capsule', 'BD3160', 5.00, 7.50],
    ['Seven Seas', 'Cod Liver Oil', 'Merck', 'Capsule', 'BD3161', 6.00, 9.00],
    ['Osteocal', 'Calcium + D3', 'Square', 'Tablet', 'BD3162', 4.50, 6.50],

    // ===== Respiratory =====
    ['Bricanyl', 'Terbutaline', 'AstraZeneca', 'Tablet', 'BD3170', 6.00, 9.00],
    ['Seretide', 'Fluticasone + Salmeterol', 'GSK', 'Inhaler', 'BD3171', 450.00, 650.00],
    ['Pulmoclear', 'Ambroxol', 'Incepta', 'Syrup', 'BD3172', 50.00, 70.00],

    // ===== Skin / Dermatology =====
    ['Clobetasol Cream', 'Clobetasol', 'Square', 'Cream', 'BD3180', 30.00, 45.00],
    ['Candistatin', 'Clotrimazole', 'Renata', 'Cream', 'BD3181', 25.00, 40.00],
    ['Fungicide', 'Ketoconazole', 'Incepta', 'Cream', 'BD3182', 28.00, 42.00],

    // ===== Eye Drops =====
    ['Oflox Eye Drop', 'Ofloxacin', 'Square', 'Drops', 'BD3190', 60.00, 85.00],
    ['TobraDex', 'Tobramycin + Dexamethasone', 'Alcon', 'Drops', 'BD3191', 95.00, 140.00],

    // ===== Pain / Anti-inflammatory =====
    ['Arinac', 'Ibuprofen + Pseudoephedrine', 'Abbott', 'Tablet', 'BD3200', 3.50, 5.00],
    ['Zerodol', 'Aceclofenac', 'Ipca', 'Tablet', 'BD3201', 4.00, 6.00],
    ['Movex', 'Diclofenac', 'Square', 'Tablet', 'BD3202', 3.00, 4.50],

    // ===== Emergency / Injection =====
    ['Adrenaline Inj', 'Epinephrine', 'Hospital Use', 'Injection', 'BD3210', 80.00, 120.00],
    ['Hydrocortisone Inj', 'Hydrocortisone', 'Square', 'Injection', 'BD3211', 50.00, 80.00],

    // ===== Pediatric =====
    ['Pedialyte', 'ORS Solution', 'Abbott', 'Syrup', 'BD3220', 40.00, 60.00],
    ['Baby Zinc', 'Zinc Sulphate', 'Renata', 'Syrup', 'BD3221', 35.00, 55.00],

    // ===== Mental Health / Neurology =====
    ['Sedil', 'Diazepam', 'Square', 'Tablet', 'BD3230', 5.00, 7.50],
    ['Zoloft', 'Sertraline', 'Pfizer', 'Tablet', 'BD3231', 10.00, 15.00],
    ['Lexotanil', 'Bromazepam', 'Roche', 'Tablet', 'BD3232', 8.00, 12.00],

        // ===== Extra Antibiotics (Common BD Brands) =====
    ['Moxacil', 'Amoxicillin', 'Square', 'Capsule', 'BD3300', 5.00, 7.50],
    ['Ampiclox', 'Ampicillin + Cloxacillin', 'GSK', 'Capsule', 'BD3301', 6.00, 9.00],
    ['Cloxin', 'Cloxacillin', 'Square', 'Capsule', 'BD3302', 5.50, 8.00],
    ['Cefspan', 'Cefixime', 'Square', 'Tablet', 'BD3303', 18.00, 26.00],
    ['Novacef', 'Cefuroxime', 'Incepta', 'Tablet', 'BD3304', 20.00, 30.00],

    // ===== Flu / Cold / Fever =====
    ['Fluclox', 'Flucloxacillin', 'Renata', 'Capsule', 'BD3310', 6.00, 9.00],
    ['Gripax', 'Paracetamol + Phenylephrine', 'Square', 'Tablet', 'BD3311', 3.50, 5.00],
    ['Coldex', 'Antihistamine Combo', 'Incepta', 'Tablet', 'BD3312', 3.00, 4.50],
    ['Sinarest', 'Paracetamol + Chlorpheniramine', 'Centaur', 'Tablet', 'BD3313', 4.00, 6.00],

    // ===== Gastric Heavy Use =====
    ['Zoton', 'Lansoprazole', 'Takeda', 'Capsule', 'BD3320', 7.00, 10.00],
    ['Pariet', 'Rabeprazole', 'Janssen', 'Tablet', 'BD3321', 8.00, 12.00],
    ['Controloc', 'Pantoprazole', 'Takeda', 'Tablet', 'BD3322', 6.50, 9.50],

    // ===== Heart / Cholesterol =====
    ['Rosuvas', 'Rosuvastatin', 'Square', 'Tablet', 'BD3330', 10.00, 15.00],
    ['Lipitor', 'Atorvastatin', 'Pfizer', 'Tablet', 'BD3331', 12.00, 18.00],
    ['Cardace', 'Ramipril', 'Sanofi', 'Tablet', 'BD3332', 9.00, 13.00],

    // ===== Diabetes Advanced =====
    ['Januvia', 'Sitagliptin', 'MSD', 'Tablet', 'BD3340', 35.00, 50.00],
    ['Galvus', 'Vildagliptin', 'Novartis', 'Tablet', 'BD3341', 30.00, 45.00],
    ['Forxiga', 'Dapagliflozin', 'AstraZeneca', 'Tablet', 'BD3342', 40.00, 60.00],

    // ===== Pain Killers Strong =====
    ['Etoricox', 'Etoricoxib', 'Square', 'Tablet', 'BD3350', 6.00, 9.00],
    ['Celebrex', 'Celecoxib', 'Pfizer', 'Capsule', 'BD3351', 15.00, 22.00],
    ['Arcoxia', 'Etoricoxib', 'MSD', 'Tablet', 'BD3352', 12.00, 18.00],

    // ===== Vitamins High Demand =====
    ['Multivita', 'Multivitamin', 'Square', 'Tablet', 'BD3360', 5.00, 7.50],
    ['Vitamin D3', 'Cholecalciferol', 'Incepta', 'Capsule', 'BD3361', 6.00, 9.00],
    ['OsteoCare', 'Calcium + D3', 'Square', 'Tablet', 'BD3362', 4.50, 6.50],

    // ===== Eye / ENT =====
    ['Alcon Tears', 'Lubricant Eye Drop', 'Alcon', 'Drops', 'BD3370', 80.00, 120.00],
    ['Xalatan', 'Latanoprost', 'Pfizer', 'Drops', 'BD3371', 150.00, 220.00],
    ['Otomax', 'Ear Drop', 'Incepta', 'Drops', 'BD3372', 50.00, 75.00],

    // ===== Skin / Dermatology =====
    ['Luliconazole', 'Antifungal', 'GSK', 'Cream', 'BD3380', 35.00, 55.00],
    ['Miconazole', 'Antifungal', 'Square', 'Cream', 'BD3381', 25.00, 40.00],
    ['Ketoconazole Shampoo', 'Antifungal Shampoo', 'Incepta', 'Shampoo', 'BD3382', 90.00, 140.00],

    // ===== Neurology / Mental Health =====
    ['Seroquel', 'Quetiapine', 'AstraZeneca', 'Tablet', 'BD3390', 18.00, 25.00],
    ['Cipralex', 'Escitalopram', 'Lundbeck', 'Tablet', 'BD3391', 12.00, 18.00],
    ['Alprazolam', 'Anxiolytic', 'Pfizer', 'Tablet', 'BD3392', 10.00, 15.00],

    // ===== Emergency / Injection =====
    ['Morphine', 'Morphine Sulphate', 'Hospital Use', 'Injection', 'BD3400', 120.00, 180.00],
    ['Dextrose', 'IV Fluid', 'Square', 'Injection', 'BD3401', 50.00, 80.00],
    ['Normal Saline', '0.9% NaCl', 'Beximco', 'IV Fluid', 'BD3402', 40.00, 70.00],

    // ===== Extra OTC Bangladesh Common =====
    ['ORS Plus', 'Electrolyte Solution', 'Square', 'Sachet', 'BD3410', 6.00, 9.00],
    ['Entacyd', 'Antacid', 'Square', 'Tablet', 'BD3411', 3.00, 5.00],
    ['Digene', 'Antacid', 'Abbott', 'Tablet', 'BD3412', 4.00, 6.00],
    ['Pudin Hara', 'Herbal Digestive', 'Hamdard', 'Liquid', 'BD3413', 35.00, 55.00],
    ['Eno', 'Antacid Powder', 'GSK', 'Powder', 'BD3414', 12.00, 18.00],

        ];

        foreach ($medicines as $m) {
           DB::table('medicines')->updateOrInsert(
    ['barcode' => $m[4]], // UNIQUE key
    [
        'name' => $m[0],
        'generic_name' => $m[1],
        'brand' => $m[2],
        'category' => $m[3],
        'purchase_price' => $m[5],
        'sell_price' => $m[6],
        'stock' => 200,
        'is_active' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]
);
        }
    }
}