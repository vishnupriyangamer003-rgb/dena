-- Digitech Admin Panel Database
-- Generated seed data matching the live website content as of the admin-panel build.
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE IF NOT EXISTS `dena_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dena_db`;

-- --------------------------------------------------------
-- tbl_admin
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `password_plain` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_admin_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_admin` (`username`, `password`, `password_plain`, `created_at`, `updated_at`) VALUES ('admin', '$2y$10$T0rkLgvL9VsaaMz3Dy.Q4uo.7gE8dLoa0NG722wAjFfdvvmf4YT4u', 'admin123', NOW(), NOW());

-- --------------------------------------------------------
-- tbl_settings
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_settings`;
CREATE TABLE `tbl_settings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` VARCHAR(100) NOT NULL,
  `setting_value` TEXT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('site_phone1', '+91 97877 74321');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('site_phone2', '+91 96773 77488');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('site_phone3', '+91 96773 81565');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('site_email', 'info@dena.co.in');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('whatsapp_number', '919787774321');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('careers_cv_email', 'info@dena.co.in');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('experience_years', '11');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('head_office_address', 'No.116/1, II Floor, IOB Upstairs, Thanthonimalai, Karur - 639 005. Tamil Nadu, India.');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('branch_madurai_address', 'No.4/46-12, Dindigul NH Road, Near Manna Food Pvt Ltd, Nagari, Madurai - 625 221');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('branch_coimbatore_address', 'No.390/7, Vinayagar Garden, Malumichampatti, Coimbatore - 641 050');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('working_hours_weekday', 'Mon - Sat: 9:00 AM - 6:30 PM');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('working_hours_sunday', 'Sunday: Closed');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('map_embed_url', 'https://www.google.com/maps?q=No.116/1,+IOB+Upstairs,+Thanthonimalai,+Karur+639005&output=embed');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('facebook_url', '#');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('instagram_url', '#');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('twitter_url', '#');
INSERT INTO `tbl_settings` (`setting_key`, `setting_value`) VALUES ('linkedin_url', '#');

-- --------------------------------------------------------
-- tbl_banners
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_banners`;
CREATE TABLE `tbl_banners` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` VARCHAR(255) NOT NULL,
  `heading` VARCHAR(255) NOT NULL,
  `subheading` TEXT NULL,
  `btn1_text` VARCHAR(100) NULL,
  `btn1_link` VARCHAR(255) NULL,
  `btn2_text` VARCHAR(100) NULL,
  `btn2_link` VARCHAR(255) NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_banners` (`image`, `heading`, `subheading`, `btn1_text`, `btn1_link`, `btn2_text`, `btn2_link`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('banners/1.webp', 'Powering Industries Driving Automation.', 'Smart and reliable automation solutions designed to improve industrial performance and efficiency.', 'Explore Panels', 'panels.php', 'Get a Quote', 'contact.php', 1, 1, NOW(), NOW());
INSERT INTO `tbl_banners` (`image`, `heading`, `subheading`, `btn1_text`, `btn1_link`, `btn2_text`, `btn2_link`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('banners/2.png', 'Control Panels Built for Your Industry', 'Custom-designed and quality-built electrical control panels for diverse industrial applications.', 'Explore Panels', 'panels.php', 'Get a Quote', 'contact.php', 2, 1, NOW(), NOW());

-- --------------------------------------------------------
-- tbl_network
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_network`;
CREATE TABLE `tbl_network` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` VARCHAR(255) NOT NULL,
  `alt_text` VARCHAR(150) NOT NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/1.png', 'Brand logo 1', 1, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/2.jpg', 'Brand logo 2', 2, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/3.png', 'Brand logo 3', 3, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/4.png', 'Brand logo 4', 4, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/5.png', 'Brand logo 5', 5, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/6.png', 'Brand logo 6', 6, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/7.png', 'Brand logo 7', 7, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/8.webp', 'Brand logo 8', 8, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/9.webp', 'Brand logo 9', 9, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/10.png', 'Brand logo 10', 10, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/11.webp', 'Brand logo 11', 11, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/12.jpg', 'Brand logo 12', 12, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/13.webp', 'Brand logo 13', 13, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/14.png', 'Brand logo 14', 14, 1, NOW());
INSERT INTO `tbl_network` (`image`, `alt_text`, `display_order`, `status`, `created_at`) VALUES ('network/15.png', 'Brand logo 15', 15, 1, NOW());

-- --------------------------------------------------------
-- tbl_certificates
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_certificates`;
CREATE TABLE `tbl_certificates` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` VARCHAR(255) NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `description` TEXT NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_certificates` (`image`, `title`, `description`, `display_order`, `status`, `created_at`) VALUES ('certificates/iso.webp', 'ISO 9001:2015', 'Quality Management System Certification', 1, 1, NOW());
INSERT INTO `tbl_certificates` (`image`, `title`, `description`, `display_order`, `status`, `created_at`) VALUES ('certificates/msme.webp', 'MSME Registration', 'Government Recognized Enterprise', 2, 1, NOW());
INSERT INTO `tbl_certificates` (`image`, `title`, `description`, `display_order`, `status`, `created_at`) VALUES ('certificates/electrical-compliance.jpg', 'Electrical Compliance', 'Safety & Standards Certification', 3, 1, NOW());

-- --------------------------------------------------------
-- tbl_panels
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_panels`;
CREATE TABLE `tbl_panels` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(150) NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `short_description` TEXT NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `overview` TEXT NULL,
  `specs` TEXT NULL,
  `applications` TEXT NULL,
  `features` TEXT NULL,
  `meta_title` VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `meta_keywords` VARCHAR(255) NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_panel_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_panels` (`slug`, `title`, `short_description`, `image`, `overview`, `specs`, `applications`, `features`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('plc-panel', 'PLC Panel', 'Programmable Logic Controller panels for precise process automation and control.', 'panels/plc-panel.jpeg', 'Our PLC Panels are engineered to automate and control industrial processes with speed, accuracy and reliability. Built around trusted PLC brands, each panel is designed for the specific logic, I/O count and communication requirements of your application — from simple machine control to fully integrated plant automation.

Every panel is assembled, wired and tested in-house before dispatch, ensuring a plug-and-play experience at site with minimal commissioning time.', '{"PLC Make":"Siemens \\/ Allen-Bradley \\/ Delta \\/ Mitsubishi (as per requirement)","Enclosure":"IP54 \\/ IP65 powder-coated sheet steel","I\\/O Capacity":"Configurable digital & analog I\\/O","Communication":"Modbus RTU\\/TCP, Ethernet\\/IP, Profibus, Profinet","HMI Compatibility":"4\\" to 15\\" touch HMI integration available","Power Supply":"415V 3-phase \\/ 230V single-phase, with SMPS\\/UPS backup"}', '["Machine automation & process control","Water & sewage treatment plants","Packaging and material handling lines","Textile and chemical process industries","Conveyor and batching systems"]', '["Compact, well-ventilated and labelled wiring for easy maintenance","Factory tested logic before dispatch","Remote monitoring & SCADA\\/HMI integration ready","Short-circuit and overload protection built in","Custom logic programming as per process requirement"]', 'PLC Panel - Electrical Control Panel Manufacturer | Digitech', 'Programmable Logic Controller panels for precise process automation and control. Engineered and manufactured by Digitech Electrical & Automations.', 'plc panel, plc panel manufacturer, electrical control panel, Digitech panel manufacturer, industrial control panel Karur', 1, 1, NOW(), NOW());
INSERT INTO `tbl_panels` (`slug`, `title`, `short_description`, `image`, `overview`, `specs`, `applications`, `features`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('mcc-panel', 'MCC Panel', 'Motor Control Centres for centralized control of multiple motors.', 'panels/mcc-panel.jpg', 'Our Motor Control Centres (MCC) bring together the starters, protection devices and control circuitry for multiple motors into a single, organized assembly. Each feeder module is engineered for the specific motor rating and starting method, giving you centralized control and monitoring across your plant.

Panels are built with modular, easily serviceable feeder compartments so that maintenance or replacement of any single motor circuit never disrupts the rest of the installation.', '{"Starter Types":"DOL, Star-Delta, Soft Starter, VFD combination feeders","Busbar Rating":"As per load schedule, copper busbars","Breaking Capacity":"As per fault level study (kA rms)","Enclosure":"IP54 powder-coated sheet steel, form 3b\\/4b construction","Metering":"Ammeter, voltmeter, indication lamps per feeder","Power Supply":"415V 3-phase, with control voltage 230V\\/24V DC"}', '["Process and manufacturing plants","Water and wastewater treatment facilities","Cement and material handling plants","Textile and spinning mills","HVAC and utility motor control"]', '["Modular, withdrawable feeder modules for easy maintenance","Interlocked compartment doors for operator safety","Thermal overload and short-circuit protection on every feeder","Remote monitoring and SCADA integration ready","Factory routine tested before dispatch"]', 'MCC Panel - Electrical Control Panel Manufacturer | Digitech', 'Motor Control Centres for centralized control of multiple motors. Engineered and manufactured by Digitech Electrical & Automations.', 'mcc panel, mcc panel manufacturer, electrical control panel, Digitech panel manufacturer, industrial control panel Karur', 2, 1, NOW(), NOW());
INSERT INTO `tbl_panels` (`slug`, `title`, `short_description`, `image`, `overview`, `specs`, `applications`, `features`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('pcc-panel', 'PCC Panel', 'Power Control Centres for reliable distribution of incoming power.', 'panels/pcc-panel.jpg', 'Power Control Centres form the heart of your electrical distribution — receiving incoming power from the transformer or utility and distributing it safely to downstream MCCs, DBs and process loads through protected outgoing feeders.

Each PCC is designed around your load schedule and fault level requirements, with incomer and bus-coupler arrangements built for safe switching and future scalability.', '{"Incomer Rating":"As per connected load, ACB\\/MCCB incomer","Busbar Material":"Copper, tin-plated, sized for full load + growth margin","Breaking Capacity":"As per fault level study (kA rms)","Enclosure":"IP54 powder-coated sheet steel, form 3b\\/4b construction","Metering":"Digital energy meter, ammeter, voltmeter with selector switch","Protection":"Overload, short-circuit, earth fault and under\\/over voltage"}', '["Industrial plant incoming power distribution","Substations and utility switch rooms","Commercial and institutional buildings","Cement, steel and process industries","Standby\\/DG synchronization panels"]', '["ACB\\/MCCB incomer with bus-coupler for redundancy","Electrical and mechanical interlocking for safe operation","Fault indication and annunciation","Busbar chamber segregated from cable alley for safety","Factory tested for insulation and functional performance"]', 'PCC Panel - Electrical Control Panel Manufacturer | Digitech', 'Power Control Centres for reliable distribution of incoming power. Engineered and manufactured by Digitech Electrical & Automations.', 'pcc panel, pcc panel manufacturer, electrical control panel, Digitech panel manufacturer, industrial control panel Karur', 3, 1, NOW(), NOW());
INSERT INTO `tbl_panels` (`slug`, `title`, `short_description`, `image`, `overview`, `specs`, `applications`, `features`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('apfc-panel', 'APFC Panel', 'Automatic Power Factor Correction panels to optimize energy efficiency.', 'panels/apfc-panel.jpeg', 'Our APFC Panels automatically switch capacitor banks in and out of circuit to keep your power factor close to unity, reducing electricity bill penalties and losses caused by reactive power drawn from inductive loads such as motors and transformers.

A digital power factor controller continuously monitors load conditions and switches capacitor steps through duty-rated contactors, keeping correction accurate even as your load varies through the day.', '{"Capacity Range":"Sized as per kVAR requirement of installation","Controller":"Digital APFC relay with multi-step switching","Capacitor Type":"Heavy-duty, low-loss APFC-grade capacitors","Switching":"Capacitor duty contactors with reactor for inrush limiting","Enclosure":"IP54 powder-coated sheet steel, forced ventilation","Protection":"Fuse\\/MCCB protection per step, harmonic filter option"}', '["Industries with heavy motor and inductive loads","Textile, cement and chemical plants","Commercial buildings and malls","Water treatment and pumping stations","Any installation billed on power factor penalty"]', '["Automatic step-wise capacitor switching for accurate correction","Digital power factor controller with real-time display","Harmonic filter reactors available for capacitor protection","Thermal overload and fuse protection per capacitor bank","Reduces demand charges and improves system efficiency"]', 'APFC Panel - Electrical Control Panel Manufacturer | Digitech', 'Automatic Power Factor Correction panels to optimize energy efficiency. Engineered and manufactured by Digitech Electrical & Automations.', 'apfc panel, apfc panel manufacturer, electrical control panel, Digitech panel manufacturer, industrial control panel Karur', 4, 1, NOW(), NOW());
INSERT INTO `tbl_panels` (`slug`, `title`, `short_description`, `image`, `overview`, `specs`, `applications`, `features`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('vfd-panel', 'VFD Panel', 'Variable Frequency Drive panels for smooth motor speed control.', 'panels/vfd-panel.jpg', 'Our VFD Panels house Variable Frequency Drives that control motor speed and torque precisely, reducing energy consumption on pumps, fans and conveyors while giving smoother starts and better process control than fixed-speed operation.

Each panel includes a bypass arrangement so the motor can run direct-on-line if the drive is under maintenance, keeping your process running with minimal downtime.', '{"Drive Make":"ABB \\/ Schneider \\/ Siemens \\/ Delta (as per requirement)","Power Range":"Fractional HP up to large industrial motor ratings","Enclosure":"IP54 powder-coated sheet steel with forced\\/fan cooling","Communication":"Modbus RTU\\/TCP, Ethernet\\/IP integration available","Braking":"Dynamic braking resistor option for fast decel applications","Protection":"Overload, over-voltage, under-voltage and short-circuit"}', '["Pumps, fans and blowers","Conveyor and material handling systems","Compressors and extruders","HVAC and utility motor control","Process lines requiring variable speed control"]', '["DOL bypass arrangement for continued operation during maintenance","Harmonic filters available to protect upstream equipment","Remote speed control via SCADA\\/HMI or 4-20mA signal","Adjustable acceleration\\/deceleration ramp settings","Energy savings of up to 30% on variable-torque loads"]', 'VFD Panel - Electrical Control Panel Manufacturer | Digitech', 'Variable Frequency Drive panels for smooth motor speed control. Engineered and manufactured by Digitech Electrical & Automations.', 'vfd panel, vfd panel manufacturer, electrical control panel, Digitech panel manufacturer, industrial control panel Karur', 5, 1, NOW(), NOW());
INSERT INTO `tbl_panels` (`slug`, `title`, `short_description`, `image`, `overview`, `specs`, `applications`, `features`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('db-panel', 'DB Panel', 'Distribution Board panels for safe and organized power distribution.', 'panels/dbc-panel.webp', 'Distribution Board panels split incoming power supply into multiple protected circuits, each isolated and safeguarded by its own MCB or RCCB. They form the last line of distribution before power reaches lighting, socket or small machine circuits.

Our DB panels are built compact and clearly labelled, making circuit identification and future maintenance straightforward for facility teams.', '{"Poles":"Single\\/Triple pole, as per circuit requirement","Rating Range":"MCB\\/RCCB rated 6A to 63A per circuit","Enclosure":"IP42\\/IP54 powder-coated sheet steel","Breaking Capacity":"10kA as per IS\\/IEC standard","Mounting":"Surface or flush wall mounting","Protection":"Overload, short-circuit and earth leakage (RCCB)"}', '["Commercial and residential buildings","Factory lighting and small load distribution","Sub-distribution within larger installations","Retail and institutional facilities","Site and temporary power distribution"]', '["Clearly labelled circuits for easy identification","MCB\\/RCCB\\/RCBO protection on every outgoing circuit","Surge protection device option for sensitive loads","Compact footprint suited for wall mounting","Tool-free access for routine maintenance"]', 'DB Panel - Electrical Control Panel Manufacturer | Digitech', 'Distribution Board panels for safe and organized power distribution. Engineered and manufactured by Digitech Electrical & Automations.', 'db panel, db panel manufacturer, electrical control panel, Digitech panel manufacturer, industrial control panel Karur', 6, 1, NOW(), NOW());
INSERT INTO `tbl_panels` (`slug`, `title`, `short_description`, `image`, `overview`, `specs`, `applications`, `features`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('servo-drive-panel', 'Servo Drive Panel', 'Servo drive panels for high-precision motion control applications.', 'panels/product-servo.jpg', 'Our Servo Drive Panels integrate servo drives and controllers to deliver precise, high-speed motion control for automated machinery. Panels are configured for single or multi-axis synchronization depending on the motion profile your application demands.

Careful attention to wiring layout, shielding and thermal management ensures signal integrity and consistent performance even in demanding production environments.', '{"Servo Make":"Yaskawa \\/ Delta \\/ Panasonic \\/ Mitsubishi (as per requirement)","Axis Count":"Single to multi-axis synchronized configurations","Communication":"EtherCAT, CANopen, Modbus TCP","Enclosure":"IP54 powder-coated sheet steel with shielded cable glands","Feedback":"Encoder\\/resolver feedback integration","Power Supply":"415V 3-phase with regenerative braking unit option"}', '["Packaging and labelling machines","CNC and precision machine tools","Robotics and pick-and-place systems","Printing and converting machinery","Automated assembly lines"]', '["Multi-axis motion synchronization","Encoder feedback integration for closed-loop accuracy","Shielded, well-organized wiring to minimize signal noise","PLC\\/HMI integration ready","Thermal management for continuous duty operation"]', 'Servo Drive Panel - Electrical Control Panel Manufacturer | Digitech', 'Servo drive panels for high-precision motion control applications. Engineered and manufactured by Digitech Electrical & Automations.', 'servo drive panel, servo drive panel manufacturer, electrical control panel, Digitech panel manufacturer, industrial control panel Karur', 7, 1, NOW(), NOW());
INSERT INTO `tbl_panels` (`slug`, `title`, `short_description`, `image`, `overview`, `specs`, `applications`, `features`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('mcb-panel', 'MCB Panel', 'MCB panels providing reliable circuit protection and isolation.', 'panels/mcb-panel.jpg', 'MCB Panels house Miniature Circuit Breakers arranged for clean, reliable protection and isolation of individual circuits. They''re built for straightforward operation and maintenance, ideal wherever multiple smaller loads need independent, easily identifiable protection.

DIN-rail mounted breakers, clear circuit labelling and a compact enclosure make these panels quick to install and simple to maintain.', '{"Poles":"Single, double, triple and four pole options","Breaking Capacity":"6kA-10kA as per IS\\/IEC standard","Rating Range":"6A to 63A per breaker","Enclosure":"IP42\\/IP54 powder-coated sheet steel","Mounting":"DIN-rail mounted, surface or flush enclosure","Protection Options":"RCCB\\/RCBO add-on for earth leakage protection"}', '["Lighting and small power circuits","Small machine and equipment protection","Office and commercial wiring","Sub-distribution boards within larger panels","Residential and light industrial installations"]', '["DIN-rail mounted MCBs for tidy, serviceable layout","Clear, durable circuit labelling","RCCB\\/RCBO options for earth leakage protection","Compact footprint for space-constrained installations","Tool-free access for quick breaker replacement"]', 'MCB Panel - Electrical Control Panel Manufacturer | Digitech', 'MCB panels providing reliable circuit protection and isolation. Engineered and manufactured by Digitech Electrical & Automations.', 'mcb panel, mcb panel manufacturer, electrical control panel, Digitech panel manufacturer, industrial control panel Karur', 8, 1, NOW(), NOW());
INSERT INTO `tbl_panels` (`slug`, `title`, `short_description`, `image`, `overview`, `specs`, `applications`, `features`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('relay-logic-panel', 'Relay Logic Panel', 'Relay logic panels for dependable electromechanical control schemes.', 'panels/relay-panel.jpg', 'Relay Logic Panels use electromechanical relays and timers to implement control sequences and interlocking logic without a programmable controller. They remain a robust, cost-effective choice for simple automation, retrofit projects and backup control schemes.

Every panel is wired with clear terminal numbering and relay labelling, so troubleshooting and future modification can be done quickly without specialized programming knowledge.', '{"Relay Type":"Electromechanical control relays, plug-in base mounted","Timers":"ON-delay\\/OFF-delay timers as per logic requirement","Enclosure":"IP54 powder-coated sheet steel","Control Voltage":"230V AC \\/ 24V DC control circuits","Wiring":"Numbered ferruled wiring with terminal blocks","Indication":"Panel-mounted indication lamps for relay\\/logic status"}', '["Legacy machine control retrofits","Simple interlocking and safety circuits","Backup\\/manual control for automated lines","Utility and auxiliary control panels","Applications where PLC programming isn''t required"]', '["Robust electromechanical logic with no programming required","Easy visual troubleshooting via relay status indicators","Cost-effective for straightforward control schemes","Numbered, ferruled wiring for easy tracing","Long service life with readily available replacement relays"]', 'Relay Logic Panel - Electrical Control Panel Manufacturer | Digitech', 'Relay logic panels for dependable electromechanical control schemes. Engineered and manufactured by Digitech Electrical & Automations.', 'relay logic panel, relay logic panel manufacturer, electrical control panel, Digitech panel manufacturer, industrial control panel Karur', 9, 1, NOW(), NOW());
INSERT INTO `tbl_panels` (`slug`, `title`, `short_description`, `image`, `overview`, `specs`, `applications`, `features`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('street-light-control-panel', 'Street Light Control Panel', 'Automated control panels for efficient street lighting networks.', 'panels/streetlight-panel.jpg', 'Our Street Light Control Panels automate the switching of street and area lighting networks, using photocell, timer or astronomical clock control to turn lighting on at dusk and off at dawn — cutting energy waste from manual operation.

Weatherproof construction and staged contactor switching make these panels suitable for outdoor installation across municipal, highway and campus lighting networks.', '{"Control Mode":"Photocell, timer or astronomical clock based switching","Load Capacity":"Sized as per number of lighting points\\/feeders","Enclosure":"IP65 weatherproof outdoor enclosure","Switching":"Contactor-based staged switching per feeder","Communication":"GSM\\/IoT remote monitoring available","Protection":"Overload, short-circuit and surge protection"}', '["Municipal and street lighting networks","Highway and expressway lighting","Parks, campuses and public spaces","Industrial yard and perimeter lighting","Residential township common-area lighting"]', '["Automatic dusk-to-dawn switching via photocell\\/timer","Manual override for maintenance or testing","Staged relay switching to reduce inrush load","Weatherproof IP65 enclosure for outdoor duty","Optional remote monitoring for fault and status reporting"]', 'Street Light Control Panel - Electrical Control Panel Manufacturer | Digitech', 'Automated control panels for efficient street lighting networks. Engineered and manufactured by Digitech Electrical & Automations.', 'street light control panel, street light control panel manufacturer, electrical control panel, Digitech panel manufacturer, industrial control panel Karur', 10, 1, NOW(), NOW());
INSERT INTO `tbl_panels` (`slug`, `title`, `short_description`, `image`, `overview`, `specs`, `applications`, `features`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('dol-star-delta-panel', 'DOL & Star Delta Starter Panel', 'Starter panels for safe and efficient motor starting.', 'panels/dol-panel.jpg', 'These panels provide the right starting method for your motor — Direct-On-Line (DOL) for smaller motors, or Star-Delta for larger motors that need reduced inrush current during start-up. Correct starter selection protects both the motor and your upstream electrical network.

Each panel includes overload and short-circuit protection along with clear indication, so operators always know the running status of the connected motor.', '{"Starter Type":"DOL or Star-Delta, selected as per motor rating","Motor Rating":"Sized as per connected motor HP\\/kW","Timer":"Star-to-delta transition timer (for Star-Delta type)","Enclosure":"IP54 powder-coated sheet steel","Protection":"Thermal overload relay and short-circuit protection","Control":"Manual\\/Auto selector with local-remote control option"}', '["Water and irrigation pumps","Compressors and blowers","Small to medium industrial motors","Agricultural and borewell motor starting","General purpose machine drives"]', '["Reduced starting current with Star-Delta configuration","Thermal overload and short-circuit protection built in","Clear ON\\/OFF\\/trip indication lamps","Manual or automatic control options","Compact, robust construction for long service life"]', 'DOL & Star Delta Starter Panel - Electrical Control Panel Manufacturer | Digitech', 'Starter panels for safe and efficient motor starting. Engineered and manufactured by Digitech Electrical & Automations.', 'dol & star delta starter panel, dol & star delta starter panel manufacturer, electrical control panel, Digitech panel manufacturer, industrial control panel Karur', 11, 1, NOW(), NOW());

-- --------------------------------------------------------
-- tbl_products
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE `tbl_products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(150) NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `points` TEXT NULL,
  `meta_title` VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `meta_keywords` VARCHAR(255) NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_product_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_products` (`slug`, `title`, `image`, `description`, `points`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('gear-box', 'Gear Box', 'products/product-gearbox.jpg', 'We supply industrial gear boxes engineered for reliable torque conversion and speed reduction across a wide range of machinery. Selected from trusted manufacturers, every unit is matched to your load, ratio and mounting requirement — whether it''s a conveyor drive or a heavy-duty mixer.', '["High torque density in a compact footprint","Low-backlash precision options available","Corrosion-resistant housing options","Long service life with minimal maintenance","Compatible with standard motor frame sizes"]', 'Gear Box Supplier - Industrial Products | Digitech', 'Gear Box supplied by Digitech Electrical & Automations. We supply industrial gear boxes engineered for reliable torque conversion and speed reduction across a wide range of machinery. Selected from trusted manufacturers, every unit is matched to your load, ratio and mounting requirement — whether it''s a conveyor drive or a heavy-duty mixer.', 'gear box, gear box supplier, industrial gear box, Digitech products Karur', 1, 1, NOW(), NOW());
INSERT INTO `tbl_products` (`slug`, `title`, `image`, `description`, `points`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('sensor', 'Sensor', 'products/product-sensors.jpg', 'Our sensor range covers proximity, photoelectric, ultrasonic and level sensors used to detect, measure and monitor conditions across automated systems. Each sensor is selected to match your process''s speed, environment and accuracy needs.', '["Fast response time for high-speed lines","Robust housing for harsh environments","Wide operating temperature tolerance","Adjustable sensitivity\\/range","Multiple output configurations (NPN\\/PNP)"]', 'Sensor Supplier - Industrial Products | Digitech', 'Sensor supplied by Digitech Electrical & Automations. Our sensor range covers proximity, photoelectric, ultrasonic and level sensors used to detect, measure and monitor conditions across automated systems. Each sensor is selected to match your process''s speed, environment and accuracy needs.', 'sensor, sensor supplier, industrial sensor, Digitech products Karur', 2, 1, NOW(), NOW());
INSERT INTO `tbl_products` (`slug`, `title`, `image`, `description`, `points`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('servo-drive-motor', 'Servo Drive & Motor', 'products/product-servo.jpg', 'Our servo drives and motors are supplied and matched as a set to deliver precise, high-speed motion control for demanding automation applications — from single-axis machines to multi-axis synchronized systems.', '["High dynamic response for fast cycle times","Multi-axis synchronization support","Compact motor and drive footprint","Encoder feedback for closed-loop accuracy","Built-in overload and short-circuit protection"]', 'Servo Drive & Motor Supplier - Industrial Products | Digitech', 'Servo Drive & Motor supplied by Digitech Electrical & Automations. Our servo drives and motors are supplied and matched as a set to deliver precise, high-speed motion control for demanding automation applications — from single-axis machines to multi-axis synchronized systems.', 'servo drive & motor, servo drive & motor supplier, industrial servo drive & motor, Digitech products Karur', 3, 1, NOW(), NOW());
INSERT INTO `tbl_products` (`slug`, `title`, `image`, `description`, `points`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('switchgear', 'SwitchGear', 'products/product-switchgear.jpg', 'We supply switchgear components — ACBs, MCCBs and associated switching devices — that form the backbone of safe electrical distribution, selected for the fault level, current rating and operating requirement of your installation.', '["Reliable fault interruption and isolation","Manual and motorized operation options","Compact design for space-constrained panels","Built-in safety interlocks","Long mechanical and electrical life"]', 'SwitchGear Supplier - Industrial Products | Digitech', 'SwitchGear supplied by Digitech Electrical & Automations. We supply switchgear components — ACBs, MCCBs and associated switching devices — that form the backbone of safe electrical distribution, selected for the fault level, current rating and operating requirement of your installation.', 'switchgear, switchgear supplier, industrial switchgear, Digitech products Karur', 4, 1, NOW(), NOW());
INSERT INTO `tbl_products` (`slug`, `title`, `image`, `description`, `points`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('ac-motor', 'AC Motor', 'products/product-acmotor.jpg', 'Our AC motors are supplied across a wide power range to suit pumps, fans, conveyors, compressors and general industrial drive applications, whether run direct-on-line or through a VFD.', '["Robust construction for continuous duty","High-efficiency options available","Wide power range to match any application","Fully compatible with VFD operation","Low maintenance, long service life"]', 'AC Motor Supplier - Industrial Products | Digitech', 'AC Motor supplied by Digitech Electrical & Automations. Our AC motors are supplied across a wide power range to suit pumps, fans, conveyors, compressors and general industrial drive applications, whether run direct-on-line or through a VFD.', 'ac motor, ac motor supplier, industrial ac motor, Digitech products Karur', 5, 1, NOW(), NOW());
INSERT INTO `tbl_products` (`slug`, `title`, `image`, `description`, `points`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('encoder', 'Encoder', 'products/product-encoder.jpg', 'Our encoders deliver accurate position and speed feedback for closed-loop control systems, compatible with a wide range of PLCs, drives and servo systems — available in incremental and absolute types.', '["High-resolution accuracy for fine control","Compact, robust housing","Wide compatibility with PLCs and drives","Resistant to vibration and shock","Solid or hollow-shaft mounting options"]', 'Encoder Supplier - Industrial Products | Digitech', 'Encoder supplied by Digitech Electrical & Automations. Our encoders deliver accurate position and speed feedback for closed-loop control systems, compatible with a wide range of PLCs, drives and servo systems — available in incremental and absolute types.', 'encoder, encoder supplier, industrial encoder, Digitech products Karur', 6, 1, NOW(), NOW());
INSERT INTO `tbl_products` (`slug`, `title`, `image`, `description`, `points`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('thermocouple', 'ThermoCouple', 'products/product-thermocouple.jpg', 'We supply industrial thermocouples for accurate temperature sensing across demanding process conditions — from furnaces and boilers to general process heating — in multiple types and lengths.', '["Wide temperature range coverage","Fast thermal response","Durable sheath construction","Multiple junction options for different needs","Compatible with standard temperature controllers"]', 'ThermoCouple Supplier - Industrial Products | Digitech', 'ThermoCouple supplied by Digitech Electrical & Automations. We supply industrial thermocouples for accurate temperature sensing across demanding process conditions — from furnaces and boilers to general process heating — in multiple types and lengths.', 'thermocouple, thermocouple supplier, industrial thermocouple, Digitech products Karur', 7, 1, NOW(), NOW());
INSERT INTO `tbl_products` (`slug`, `title`, `image`, `description`, `points`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('wires-cables', 'Wires & Cables', 'products/product-wires.jpg', 'We supply quality electrical wires and cables for panel wiring, control circuits, power distribution and field instrumentation, selected for the right conductor size, insulation grade and standard compliance.', '["Flame-retardant (FRLS) options available","Durable, long-lasting insulation","Colour-coded conductors for easy identification","Compliant with IS\\/IEC standards","Wide size range for every application"]', 'Wires & Cables Supplier - Industrial Products | Digitech', 'Wires & Cables supplied by Digitech Electrical & Automations. We supply quality electrical wires and cables for panel wiring, control circuits, power distribution and field instrumentation, selected for the right conductor size, insulation grade and standard compliance.', 'wires & cables, wires & cables supplier, industrial wires & cables, Digitech products Karur', 8, 1, NOW(), NOW());
INSERT INTO `tbl_products` (`slug`, `title`, `image`, `description`, `points`, `meta_title`, `meta_description`, `meta_keywords`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('temperature-controller', 'Temperature Controller', 'products/product-tempctrl.jpg', 'Our digital temperature controllers provide precise monitoring and regulation for industrial heating, cooling and process applications, and integrate easily into new or existing control panels.', '["PID auto-tuning for stable control","Clear, easy-to-read digital display","Compatible with multiple sensor inputs","Alarm output options available","Compact panel-mount design"]', 'Temperature Controller Supplier - Industrial Products | Digitech', 'Temperature Controller supplied by Digitech Electrical & Automations. Our digital temperature controllers provide precise monitoring and regulation for industrial heating, cooling and process applications, and integrate easily into new or existing control panels.', 'temperature controller, temperature controller supplier, industrial temperature controller, Digitech products Karur', 9, 1, NOW(), NOW());

-- --------------------------------------------------------
-- tbl_programming
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_programming`;
CREATE TABLE `tbl_programming` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(150) NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `icon` VARCHAR(100) NULL,
  `image` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `points` TEXT NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_programming_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_programming` (`slug`, `title`, `icon`, `image`, `description`, `points`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('scada', 'SCADA', 'fa-chart-network', 'programming/control-panel.jpg', 'We design and deploy SCADA systems that give you real-time visibility and control over your entire process — from field devices to a centralized operator dashboard, with historical trending and alarm management for informed decision-making.', '["Real-time data visualization","Historical trending & reporting","Alarm & event management","Remote monitoring access"]', 1, 1, NOW(), NOW());
INSERT INTO `tbl_programming` (`slug`, `title`, `icon`, `image`, `description`, `points`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('plc-hmi', 'PLC / HMI', 'fa-microchip', 'programming/plc-panel.jpeg', 'Our PLC and HMI programming covers everything from simple machine logic to complex, multi-station process control. We develop clean, well-documented logic and intuitive HMI screens that make operators'' jobs easier.', '["Ladder, structured text & function block programming","Custom HMI screen design","Multi-brand PLC expertise (Siemens, AB, Delta, Mitsubishi)","Commissioning & on-site support"]', 2, 1, NOW(), NOW());
INSERT INTO `tbl_programming` (`slug`, `title`, `icon`, `image`, `description`, `points`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('vfd-drive', 'VFD Drive', 'fa-gauge-high', 'programming/vfd-panel.jpg', 'We configure and commission Variable Frequency Drives to optimize motor performance, reduce energy consumption and give you precise process control, with parameters tuned to your specific load and application.', '["Drive parameter configuration & tuning","Energy-efficient motor control","Multi-brand drive expertise","Fault diagnostics & troubleshooting"]', 3, 1, NOW(), NOW());
INSERT INTO `tbl_programming` (`slug`, `title`, `icon`, `image`, `description`, `points`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('servo-drive', 'Servo Drive', 'fa-diagram-project', 'programming/product-servo.jpg', 'Our servo drive programming delivers precise, high-speed motion control for automation applications that demand accuracy — from pick-and-place systems to multi-axis synchronized machinery.', '["Motion profile programming","Multi-axis synchronization","Encoder feedback tuning","Integration with PLC\\/HMI systems"]', 4, 1, NOW(), NOW());

-- --------------------------------------------------------
-- tbl_training
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_training`;
CREATE TABLE `tbl_training` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(150) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_training_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_training` (`slug`, `title`, `image`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('deliver-on-core-strategy-delight-customers', 'Deliver on core strategy delight customers', 'training/1.jpg', 'Training that aligns technical execution with client expectations, helping engineers deliver every project to a standard that keeps customers coming back.', 1, 1, NOW(), NOW());
INSERT INTO `tbl_training` (`slug`, `title`, `image`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('enabling-companies-to-grow-revenue-growth', 'Enabling companies to grow revenue growth', 'training/2.jpg', 'A program building the technical and client-facing skills that help teams win more work and support the company''s long-term growth.', 2, 1, NOW(), NOW());
INSERT INTO `tbl_training` (`slug`, `title`, `image`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('an-integrated-approach-linking-acquisition', 'An integrated approach linking acquisition', 'training/3.jpg', 'A structured path from onboarding to on-site competence, connecting new equipment and technology adoption with practical, hands-on skill-building.', 3, 1, NOW(), NOW());
INSERT INTO `tbl_training` (`slug`, `title`, `image`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('predicting-measuring-managing-risk', 'Predicting, measuring & managing risk', 'training/4.jpg', 'Training focused on spotting electrical and process risks early, with practical methods to measure, monitor and manage them on live projects.', 4, 1, NOW(), NOW());
INSERT INTO `tbl_training` (`slug`, `title`, `image`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('realizing-the-full-potential-of-it-industries', 'Realizing the full potential of IT industries', 'training/5.jpg', 'Explore how automation, SCADA and digital control systems help industries unlock efficiency through smarter monitoring and integration.', 5, 1, NOW(), NOW());
INSERT INTO `tbl_training` (`slug`, `title`, `image`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('an-integrated-approach-linking-acquisition-2', 'An integrated approach linking acquisition', 'training/6.jpg', 'Hands-on sessions that connect newly acquired equipment and processes with the skills your team needs to operate them confidently.', 6, 1, NOW(), NOW());
INSERT INTO `tbl_training` (`slug`, `title`, `image`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('predicting-measuring-managing-risk-2', 'Predicting, measuring & managing risk', 'training/7.jpg', 'Practical risk-assessment exercises covering electrical safety, fault prediction and preventive checks before issues become downtime.', 7, 1, NOW(), NOW());
INSERT INTO `tbl_training` (`slug`, `title`, `image`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('realizing-the-full-potential-of-it-industries-2', 'Realizing the full potential of IT industries', 'training/8.jpg', 'A closer look at how connected automation and data-driven control systems are reshaping efficiency across industrial sectors.', 8, 1, NOW(), NOW());
INSERT INTO `tbl_training` (`slug`, `title`, `image`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('ensuring-the-entire-thing-is-aligned', 'Ensuring the entire thing is aligned', 'training/9.jpg', 'Comprehensive training ensuring every stage of a project — design, wiring, programming and commissioning — stays aligned from start to finish.', 9, 1, NOW(), NOW());

-- --------------------------------------------------------
-- tbl_careers
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_careers`;
CREATE TABLE `tbl_careers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` VARCHAR(150) NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `location` VARCHAR(150) NULL,
  `experience` VARCHAR(100) NULL,
  `description` TEXT NOT NULL,
  `display_order` INT NOT NULL DEFAULT 0,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_careers_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_careers` (`slug`, `title`, `location`, `experience`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('electrical-design-engineer', 'Electrical Design Engineer', 'Karur', '2+ Years', 'Responsible for control panel design, load calculations and drawings using AutoCAD Electrical, in coordination with the project and manufacturing teams.', 1, 1, NOW(), NOW());
INSERT INTO `tbl_careers` (`slug`, `title`, `location`, `experience`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('plc-scada-programmer', 'PLC / SCADA Programmer', 'Karur / Site', '2+ Years', 'Develop and commission PLC logic and SCADA/HMI applications for automation projects across multiple industries.', 2, 1, NOW(), NOW());
INSERT INTO `tbl_careers` (`slug`, `title`, `location`, `experience`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('panel-wiring-technician', 'Panel Wiring Technician', 'Karur', '1+ Years', 'Assemble and wire electrical control panels as per drawings, following safety and quality standards.', 3, 1, NOW(), NOW());
INSERT INTO `tbl_careers` (`slug`, `title`, `location`, `experience`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('site-automation-engineer', 'Site Automation Engineer', 'Multiple Locations', '2+ Years', 'Handle on-site installation, commissioning and troubleshooting of control panels and automation systems.', 4, 1, NOW(), NOW());
INSERT INTO `tbl_careers` (`slug`, `title`, `location`, `experience`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('sales-business-development-executive', 'Sales & Business Development Executive', 'Madurai / Coimbatore', '1+ Years', 'Build client relationships, prepare quotations and follow up on orders for electrical and automation solutions.', 5, 1, NOW(), NOW());
INSERT INTO `tbl_careers` (`slug`, `title`, `location`, `experience`, `description`, `display_order`, `status`, `created_at`, `updated_at`) VALUES ('trainee-engineer-eee-ece', 'Trainee Engineer (EEE / ECE)', 'Karur', 'Freshers', 'On-the-job training in electrical panel design, wiring and automation, with growth into a full engineering role.', 6, 1, NOW(), NOW());

-- --------------------------------------------------------
-- tbl_enquiries
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tbl_enquiries`;
CREATE TABLE `tbl_enquiries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `email` VARCHAR(150) NULL,
  `subject` VARCHAR(255) NULL,
  `message` TEXT NULL,
  `source` ENUM('contact_form','enquire_modal') NOT NULL DEFAULT 'contact_form',
  `status` ENUM('new','contacted','closed') NOT NULL DEFAULT 'new',
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;

