-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2020 at 02:07 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bcfdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `ach_return_codes`
--

CREATE TABLE `ach_return_codes` (
  `id` int(100) NOT NULL DEFAULT 0,
  `code` varchar(3) DEFAULT NULL,
  `short_desc` varchar(100) NOT NULL,
  `brw_expo` varchar(110) DEFAULT NULL,
  `desc` varchar(67) DEFAULT NULL,
  `likely_scenario` varchar(178) DEFAULT NULL,
  `act_init` varchar(342) DEFAULT NULL,
  `act_sec` varchar(349) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ach_return_codes`
--

INSERT INTO `ach_return_codes` (`id`, `code`, `short_desc`, `brw_expo`, `desc`, `likely_scenario`, `act_init`, `act_sec`) VALUES
(1, 'R01', 'Insufficient Funds', 'there wasn\'t enough money in your account', 'Insufficient funds', 'Available balance is not sufficient to cover the dollar amount of the debit entry', 'Explain to borrwer that their funds were returned to us do to an NSF fee.', ''),
(2, 'R02', 'Closed', 'your account was closed', 'Account closed', 'A previously open account is now closed', 'Tell borrower that the bank told us the account is closed and ask for another bank account.', 'If the customer says that the account is not closed, ask the customer to contact their bank and inquire why we are recieving this return code from them'),
(3, 'R03', 'Not Found', 'they could not find your bank account', 'No account or unable to locate account', 'The account number does not correspond to a valid account.', 'Tell borrower that the routing number, account number, or account type (checking/savings) is incorrect and ask for corrected information.', 'If borrower insists there is nothing wrong with their bank please send to your manager. They will send to account.inquiry and we will look into a three way call with the bank.'),
(4, 'R04', 'Incorrect Account Number', 'your account number is not correct', 'Invalid account number', 'The account number does not correspond to a valid account.', 'Tell borrower that the routing number, account number, or account type (checking/savings) is incorrect and ask for corrected information.', ''),
(5, 'R05', 'Not Authorized', 'your account is not authorized to take payments ', 'Unauthorized debit to consumer account', 'Payment request was returned as not authorized', '(rare)', ''),
(6, 'R07', 'Revoked Authorization', 'you revoked your authorization to take payments', 'Authorization revoked by customer', 'The customer told the bank we are not authorized to take payments.', 'Get the customer\'s permission to take payments via ACH and either make the account active or get new account information.', ''),
(7, 'R08', 'Stopped Payment', 'you stopped your payment', 'Payment stopped or stop payment on item', 'Borrower had recently stopped payment on thier account', 'Get the customer\'s permission to take payments via ACH and either make the account active or get new account information.', 'If next payment does not go through and borrower insists the stop payment has been revoked send to your manager. Your manager will send to account.inquiry to see about a three way call with the bank.'),
(8, 'R09', 'Uncollected Funds', 'your bank was not able to cover your payment due to uncolected funds', 'Uncollected funds', 'Available balance is sufficient, but collected balance is not sufficient to cover the entry', '(rare)', ''),
(9, 'R10', 'Unauthorized transaction', 'you advise your bank that we are not authorized to take payments from your account', 'Customer advises not authorized', 'The customer told the bank we are not authorized to take payments.', 'The customer told the bank we are not authorized to take payments. Get the customer\'s permission to take payments via ACH and either make the account active or get new account information.', ''),
(10, 'R11', 'Amount Not accepted', 'your payment amount was not accepted', 'Check truncation entry return', 'To be used when returning a check truncation entry', '(rare)', ''),
(11, 'R13', 'Invalid Routing Number', 'your routing number was not valid', 'Invalid ACH routing number', 'Financial institution does not receive commercial ACH entries', '(rare)', ''),
(12, 'R14', '', 'your bank was not able to honor your payment', 'Representment payee deceased or unable to continue in that capacity', 'Representative payee is deceased or unable to continue in that capacity, beneficiary is not deceased', '(rare)', ''),
(13, 'R15', '', 'your account beneficially has past away', 'Beneficiary of account holder deceased', 'Beneficiary or Account Holder Deceased', '(rare)', ''),
(14, 'R16', 'Frozen', 'your bank account is frozen', 'Account frozen', 'Access to account is restricted', 'Customer froze the account. Ask them when they unfroze the account. Set the payment for at LEAST three business days from now.', ''),
(15, 'R17', 'Rejected payment', 'you bank rejected your payment, please contact your bank', 'File record edit criteria', 'Fields rejected by RDFI processing (identified in return addenda)', '(rare)', ''),
(16, 'R18', '', 'your bank received the request for your payment before the payment date', 'Improper effective entry date', 'Entries have been presented prior to the first available processing window for the effective date.', '', ''),
(17, 'R19', '', 'your payment amount was not correctly processed', 'Amount field error', 'Improper formatting of the amount field', '(rare)', ''),
(18, 'R20', '', 'your account does not accept payment through ACH', 'Nontransaction account', 'Policies prohibit or limit activity to the account indicated', 'This is an account that does not allow ACH payments (for example, a business account). Get new account information from customer.', ''),
(19, 'R21', '', '', 'Invalid company identification', 'The company ID information not valid', '(rare)', ''),
(20, 'R22', '', '', 'Invalid individual ID number', 'Individual id used by receiver is incorrect', '(rare)', ''),
(21, 'R23', '', '', 'Credit entry refused by receiver', 'Receiver returned entry', '(rare)', ''),
(22, 'R24', '', '', 'Duplicate entry', 'RDFI has received a duplicate entry', '(rare)', ''),
(23, 'R25', '', '', 'Addenda error', 'Improper formatting of the addenda record information', '(rare)', ''),
(24, 'R26', '', '', 'Mandatory field error', 'Improper information in one of the mandatory fields', '(rare)', ''),
(25, 'R27', '', '', 'Trace number error', 'Original entry trace number is not valid for return entry; or addenda trace numbers do not correspond with entry detail record', '(rare)', ''),
(26, 'R28', '', '', 'Routing number or check digit error', 'Check digit for the transit routing number is incorrect', '(rare)', ''),
(27, 'R32', '', '', 'RDFI nonsettlement', 'RDFI is not able to settle the entry', '(rare)', ''),
(28, 'R33', '', '', 'Return of XCK entry', 'RDFI determines at its sole discretion to return an XCK entry; an XCK return entry may be initiated by midnight of the sixtieth day following the settlement date if the XCK entry', '(rare)', ''),
(29, 'R34', '', '', 'Limited participation DFI', 'RDFI participation has been limited by a federal or state supervisor', '(rare)', ''),
(30, 'R35', '', '', 'Return of improper debit entry', 'ACH debit not permitted for use with the CIE standard entry class code (except for reversals)', '(rare)', ''),
(31, 'R36', '', '', 'Return of improper credit entry', '', '(rare)', ''),
(32, 'R99', '', 'our payment processor found some problems with your account, please verify if your account is closed or frozen', 'Payment not sent to bank', 'Reasons vary by ACH processor.', 'Tell customer that our payment processor saw that there was a problem with the account. It could have been recent returned payments, stopped payments, frozen account, etc. Tell the customer that we can try the payment again, OR we can try it with a different bank account, OR we can try to collect payment by other means (check, credit card).', 'T24 Update: These are declined for some reason. So if something is returned R99 by T24, we should verify with the customer if the account is closed or frozen. If closed, we should try to get new payment information. If frozen, we should make sure the customer unfreezes the account, wait 48 hours, and then re-enter the account information in admin.');

-- --------------------------------------------------------

--
-- Table structure for table `debtsalebuyers`
--

CREATE TABLE `debtsalebuyers` (
  `ID` int(10) NOT NULL,
  `Code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `PhoneNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debtsalebuyers`
--

INSERT INTO `debtsalebuyers` (`ID`, `Code`, `Name`, `PhoneNumber`) VALUES
(1, 'JTM', 'JTM Capital Management', '866-651-7663'),
(2, 'CAM', 'Crown Asset Management', '866-696-4442'),
(3, 'BWG', 'Brightwater Group - Same as C2A', '877-212-6466'),
(4, 'SWI', 'Southwestern Investor Group', '888-349-1226'),
(5, 'C2A', 'C2 Aquisitions', '877-212-6466'),
(6, 'BK', 'Not-Sold Bankruptcy', 'N/A'),
(7, 'Primary', 'Primary Financial', '800-661-0086'),
(8, 'NMRC', 'National Management Recovery Corporation', '888-220-2068');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `ID` int(255) NOT NULL,
  `type` varchar(2) NOT NULL,
  `name` varchar(42) NOT NULL,
  `catID` int(255) NOT NULL,
  `emID` varchar(255) NOT NULL,
  `status` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`ID`, `type`, `name`, `catID`, `emID`, `status`) VALUES
(1, 'rm', 'Payoff Confirmation', 1, '1', 1),
(2, 'rm', 'Payment Arrangement - Additional', 1, '2', 1),
(3, 'rm', 'Payment Arrangement - Mailed ', 1, '3', 0),
(4, 'rm', 'Payoff Request', 1, '4', 1),
(5, 'rm', 'Pay-Off Request Email - no date', 1, '5', 0),
(6, 'rm', 'Next Payment Date', 1, '6', 0),
(7, 'rm', 'First Deferral Request', 1, '7', 1),
(8, 'rm', 'Second Deferral Request', 1, '8', 0),
(9, 'rm', 'Deferral Confirmation', 1, '9', 1),
(10, 'rm', 'Deferral Window Missed', 1, '10', 1),
(11, 'rm', '4 Business Days Reminder', 1, '11', 0),
(12, 'rm', 'Payment Confirmation (Debit Card)', 1, '12', 1),
(13, 'rm', 'Missed Payment - NSF Fee', 1, '13', 0),
(14, 'rm', 'Missed Payment - No NSF Fee', 1, '14', 0),
(15, 'rm', 'NSF Response', 1, '15', 0),
(16, 'rm', 'Payoff Cancelation', 1, '16', 1),
(17, 'rm', 'Settlement Completed', 1, '17', 0),
(18, 'rm', 'Broken Agreement', 2, '1', 0),
(19, 'rm', 'Payment History', 2, '2', 1),
(20, 'rm', 'Account Balance', 2, '3', 1),
(21, 'rm', 'ACH Authtorization', 2, '4', 0),
(22, 'rm', 'Payment Options', 2, '5', 0),
(25, 'rm', 'Restructure Schedule Update', 2, '8', 0),
(26, 'rm', 'Expensive Loan Question Email.', 2, '9', 0),
(27, 'rm', 'Last payment procesing Email.', 2, '10', 0),
(28, 'rm', 'Payment Schedule', 2, '11', 0),
(29, 'rm', 'Deposit Issues 1', 3, '1', 0),
(30, 'rm', 'Deposit Issues 2', 3, '2', 0),
(31, 'rm', 'Funds deposit date', 3, '3', 0),
(32, 'rm', 'Banking Information update Request', 3, '4', 0),
(33, 'rm', 'Banking Information Change', 3, '5', 0),
(34, 'rm', 'Request for More Funds', 3, '6', 0),
(35, 'rm', 'Contact Information Change', 3, '7', 0),
(36, 'rm', 'Attempt to Call', 3, '8', 0),
(37, 'rm', 'Mailing Payment', 1, '20', 1),
(38, 'rm', 'Voided Check', 3, '10', 1),
(39, 'rm', 'No Template Email', 2, '35', 1),
(40, 'rm', 'Online account issues', 3, '12', 0),
(42, 'fr', 'Settlement Offer', 1, '1', 1),
(43, 'fr', 'New Settlement Arrangement', 1, '2', 1),
(44, 'fr', 'Broken Agreement', 1, '4', 0),
(45, 'fr', 'Settlement Broken Agreement', 1, '3', 1),
(52, 'rm', 'ACH Revocation - Unable to Stop Payment', 2, '12', 0),
(53, 'rm', 'Unable to Stop Payment', 2, '13', 0),
(54, 'rm', 'Help@ Missed Email', 2, '14', 0),
(55, 'rm', 'ACH Revoke', 2, '15', 1),
(56, 'rm', 'ACH Turned On', 2, '16', 1),
(57, 'rm', 'Additional Funds Request', 2, '17', 1),
(58, 'rm', 'Address Update', 2, '18', 1),
(59, 'rm', 'Application Problems', 2, '19', 1),
(60, 'rm', 'Application Requirements', 2, '20', 1),
(61, 'rm', 'Banking Info Updated', 2, '21', 1),
(62, 'rm', 'Banking Update Request', 2, '22', 1),
(63, 'rm', 'Bankruptcy Response', 2, '23', 1),
(64, 'rm', 'Broken Promises', 1, '18', 1),
(65, 'rm', 'Contact Attempt (Called You)', 2, '24', 1),
(66, 'rm', 'Confirmation Number Request', 2, '25', 1),
(67, 'rm', 'Contact Information Updated', 2, '26', 1),
(68, 'rm', 'Denial Response', 2, '27', 1),
(69, 'rm', 'Deposit Inquiry', 2, '28', 1),
(70, 'rm', 'Funds Returned', 2, '29', 1),
(71, 'rm', 'Incomplete Application', 2, '30', 1),
(72, 'rm', 'Interest Explanation', 2, '31', 1),
(73, 'rm', 'ISQ Account', 1, '19', 1),
(74, 'rm', 'Loan Cancellation', 2, '32', 1),
(75, 'rm', 'Missed Payment (NSF)', 1, '21', 1),
(77, 'rm', 'No Funds Received', 2, '33', 1),
(78, 'rm', 'Non-Qualifying Bank Account', 2, '34', 1),
(79, 'rm', 'Email Not Handled', 2, '36', 1),
(80, 'rm', 'Online Account Access Issues', 2, '37', 1),
(81, 'rm', 'Paid Off Spotloan', 2, '38', 1),
(82, 'rm', 'Payment Reminder', 1, '22', 1),
(83, 'rm', 'Payment Schedule', 1, '23', 1),
(84, 'rm', 'Re-Sending an Email', 2, '39', 1),
(85, 'rm', 'Restructure Confirmation', 1, '24', 1),
(86, 'rm', 'Restructure Offer', 1, '25', 1),
(87, 'rm', 'Settlement Completion Email', 2, '40', 1),
(88, 'rm', 'Sold Account', 2, '41', 1),
(89, 'rm', 'Special Payment Confirmation', 1, '26', 1),
(90, 'rm', 'State Not Eligible', 2, '42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `em_id` int(100) NOT NULL,
  `em_name` varchar(255) NOT NULL,
  `em_group` varchar(255) NOT NULL,
  `em_description` varchar(255) NOT NULL,
  `em_cat` varchar(10) NOT NULL,
  `em_cat_id` varchar(10) NOT NULL,
  `em_filename` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emtype`
--

CREATE TABLE `emtype` (
  `id` int(255) NOT NULL,
  `code` varchar(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emtype`
--

INSERT INTO `emtype` (`id`, `code`, `name`, `description`) VALUES
(1, 'rm', 'Relationship Manager', 'Relationship Manager'),
(2, 'fr', 'Collection Manager', 'Collection Manager'),
(3, 'csm', 'Credit Service Manager', 'Credit Service Manager'),
(4, 'sup', 'Supervisor', 'Supervisor Emails');

-- --------------------------------------------------------

--
-- Table structure for table `em_cat`
--

CREATE TABLE `em_cat` (
  `cat_id` int(2) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `em_cat`
--

INSERT INTO `em_cat` (`cat_id`, `cat_name`, `cat_description`, `status`) VALUES
(1, 'Payment Related Emails', 'Email under this category will be use for confirmation of payments', 1),
(2, 'Servicing Related Emails', 'These Email should be used when the changes to the account should be notified.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(255) NOT NULL,
  `rate_type` varchar(100) NOT NULL,
  `rate` int(100) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `rate_type`, `rate`, `desc`, `update`) VALUES
(1, 'new', 490, 'New Borrower', '2018-05-20'),
(2, 'return', 460, 'Returning Borrower', '2018-05-20'),
(3, 'military', 36, 'Military Rate', '2018-05-20'),
(4, 'special', 99, 'Especial Rate', '2018-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `sec_profile`
--

CREATE TABLE `sec_profile` (
  `id` int(10) NOT NULL,
  `sec_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sec_profile`
--

INSERT INTO `sec_profile` (`id`, `sec_desc`) VALUES
(1, 'Admin'),
(2, 'Manager/Supervisor'),
(3, 'Special Team'),
(4, 'Collection Manager'),
(5, 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `servicing_states`
--

CREATE TABLE `servicing_states` (
  `id` int(100) NOT NULL,
  `state_name` varchar(30) NOT NULL,
  `state_abr` varchar(30) NOT NULL,
  `state_status` varchar(10) NOT NULL,
  `state_dc_status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicing_states`
--

INSERT INTO `servicing_states` (`id`, `state_name`, `state_abr`, `state_status`, `state_dc_status`) VALUES
(1, 'Alabama', 'AL', 'Yes', 'Yes'),
(2, 'Alaska', 'AK', 'Yes', 'Yes'),
(3, 'Arizona', 'AZ', 'Yes', 'Yes'),
(4, 'Arkansas', 'AR', 'No', 'No'),
(5, 'California', 'CA', 'Yes', 'Yes'),
(6, 'Colorado', 'CO', 'Yes', 'Yes'),
(7, 'Connecticut', 'CT', 'No', 'No'),
(8, 'Delaware', 'DE', 'Yes', 'Yes'),
(9, 'District of Columbia', 'DC', 'No', 'No'),
(10, 'Florida', 'FL', 'Yes', 'Yes'),
(11, 'Georgia', 'GA', 'Yes', 'Yes'),
(12, 'Hawaii', 'HI', 'Yes', 'Yes'),
(13, 'Idaho', 'ID', 'Yes', 'Yes'),
(14, 'Illinois', 'IL', 'No', 'No'),
(15, 'Indiana', 'IN', 'Yes', 'Yes'),
(16, 'Iowa', 'IA', 'Yes', 'Yes'),
(17, 'Kansas', 'KS', 'Yes', 'Yes'),
(18, 'Kentucky', 'KY', 'Yes', 'Yes'),
(19, 'Louisiana', 'LA', 'Yes', 'Yes'),
(20, 'Maine', 'ME', 'Yes', 'Yes'),
(21, 'Maryland', 'MD', 'No', 'Yes'),
(22, 'Massachusetts', 'MA', 'No', 'Yes'),
(23, 'Michigan', 'MI', 'Yes', 'Yes'),
(24, 'Minnesota', 'MN', 'No', 'Yes'),
(25, 'Mississippi', 'MS', 'Yes', 'Yes'),
(26, 'Missouri', 'MO', 'Yes', 'Yes'),
(27, 'Montana', 'MT', 'Yes', 'Yes'),
(28, 'Nebraska', 'NE', 'Yes', 'Yes'),
(29, 'Nevada', 'NV', 'Yes', 'Yes'),
(30, 'New Hampshire', 'NH', 'Yes', 'No'),
(31, 'New Jersey', 'NJ', 'Yes', 'No'),
(32, 'New Mexico', 'NM', 'Yes', 'Yes'),
(33, 'New York', 'NY', 'No', 'Yes'),
(34, 'North Carolina', 'NC', 'Yes', 'No'),
(35, 'North Dakota', 'ND', 'No', 'Yes'),
(36, 'Ohio', 'OH', 'Yes', 'Yes'),
(37, 'Oklahoma', 'OK', 'Yes', 'Yes'),
(38, 'Oregon', 'OR', 'Yes', 'Yes'),
(39, 'Pennsylvania', 'PA', 'No', 'No'),
(40, 'Rhode Island', 'RI', 'Yes', 'Yes'),
(41, 'South Carolina', 'SC', 'Yes', 'Yes'),
(42, 'South Dakota', 'SD', 'Yes', 'Yes'),
(43, 'Tennessee', 'TN', 'Yes', 'Yes'),
(44, 'Texas', 'TX', 'Yes', 'Yes'),
(45, 'Utah', 'UT', 'Yes', 'Yes'),
(46, 'Vermont', 'VT', 'No', 'No'),
(47, 'Virginia', 'VA', 'No', 'Yes'),
(48, 'Washington', 'WA', 'Yes', 'Yes'),
(49, 'West Virginia', 'WV', 'No', 'Yes'),
(50, 'Wisconsin', 'WI', 'Yes', 'Yes'),
(51, 'Wyoming', 'WY', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `soldlist`
--

CREATE TABLE `soldlist` (
  `id` int(100) NOT NULL,
  `Loan_ID` varchar(30) NOT NULL,
  `Balance` decimal(65,0) NOT NULL,
  `Buyer` varchar(20) NOT NULL,
  `Sold_Date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soldlist`
--

INSERT INTO `soldlist` (`id`, `Loan_ID`, `Balance`, `Buyer`, `Sold_Date`) VALUES
(1, '435964589E-01', '2500', 'CAM', ' 2/24/17');

-- --------------------------------------------------------

--
-- Table structure for table `sp_contact`
--

CREATE TABLE `sp_contact` (
  `id` int(100) NOT NULL,
  `address_type` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(6) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sp_contact`
--

INSERT INTO `sp_contact` (`id`, `address_type`, `address1`, `address2`, `city`, `state`, `zipcode`, `status`) VALUES
(1, 'Physical Address', '914 Chief Little Shell St NE', '', 'Belcourt', 'ND', '58316', 1),
(2, 'Mailing Address', 'P.O. Box 720', '', 'Belcourt', 'ND', '58316', 1);

-- --------------------------------------------------------

--
-- Table structure for table `state_time_zone`
--

CREATE TABLE `state_time_zone` (
  `id` int(2) NOT NULL,
  `state_name` varchar(16) NOT NULL,
  `state_abr` varchar(2) NOT NULL,
  `zone_code` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state_time_zone`
--

INSERT INTO `state_time_zone` (`id`, `state_name`, `state_abr`, `zone_code`) VALUES
(1, 'Alabama', 'AL', 'CST'),
(2, 'Alaska', 'AK', 'AKST'),
(3, 'Arizona', 'AZ', 'MST'),
(4, 'Arkansas', 'AR', 'CST'),
(5, 'California', 'CA', 'PST'),
(6, 'Colorado', 'CO', 'MST'),
(7, 'Connecticut', 'CT', 'EST'),
(8, 'Delaware', 'DE', 'EST'),
(9, 'Florida', 'FL', 'EST'),
(10, 'Georgia', 'GA', 'EST'),
(11, 'Hawaii', 'HI', 'HST'),
(12, 'Idaho', 'ID', 'MST'),
(13, 'Illinois', 'IL', 'CST'),
(14, 'Indiana', 'IN', 'EST'),
(15, 'Iowa', 'IA', 'CST'),
(16, 'Kansas', 'KS', 'CST'),
(17, 'Kentucky', 'KY', 'CST'),
(18, 'Louisiana', 'LA', 'CST'),
(19, 'Maine', 'ME', 'EST'),
(20, 'Maryland', 'MD', 'EST'),
(21, 'Massachusetts', 'MA', 'EST'),
(22, 'Michigan', 'MI', 'EST'),
(23, 'Minnesota', 'MN', 'CST'),
(24, 'Mississippi', 'MS', 'CST'),
(25, 'Missouri', 'MO', 'CST'),
(26, 'Montana', 'MT', 'MST'),
(27, 'Nebraska', 'NE', 'CST'),
(28, 'Nevada', 'NV', 'PST'),
(29, 'New Hampshire', 'NH', 'EST'),
(30, 'New Jersey', 'NJ', 'EST'),
(31, 'New Mexico', 'NM', 'MST'),
(32, 'New York', 'NY', 'EST'),
(33, 'North Carolina', 'NC', 'EST'),
(34, 'North Dakota', 'ND', 'CST'),
(35, 'Ohio', 'OH', 'EST'),
(36, 'Oklahoma', 'OK', 'CST'),
(37, 'Oregon', 'OR', 'PST'),
(38, 'Pennsylvania', 'PA', 'EST'),
(39, 'Rhode Island', 'RI', 'EST'),
(40, 'South Carolina', 'SC', 'EST'),
(41, 'South Dakota', 'SD', 'CST'),
(42, 'Tennessee', 'TN', 'CST'),
(43, 'Texas', 'TX', 'CST'),
(44, 'Utah', 'UT', 'MST'),
(45, 'Vermont', 'VT', 'EST'),
(46, 'Virginia', 'VA', 'EST'),
(47, 'Washington', 'WA', 'PST'),
(48, 'Washington, D.C.', 'DC', 'EST'),
(49, 'West Virginia', 'WV', 'EST'),
(50, 'Wisconsin', 'WI', 'CST'),
(51, 'Wyoming', 'WY', 'MST');

-- --------------------------------------------------------

--
-- Table structure for table `time_zones`
--

CREATE TABLE `time_zones` (
  `id` int(100) NOT NULL,
  `timezone_name` varchar(255) NOT NULL,
  `timezone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_zones`
--

INSERT INTO `time_zones` (`id`, `timezone_name`, `timezone`) VALUES
(1, 'Eastern Time', ' America/New_York'),
(2, 'Central Time', ' America/Chicago'),
(3, 'Mountain Time', ' America/Denver'),
(4, 'Honduras Time', 'America/El_Salvador'),
(5, 'Pacific Time', ' America/Los_Angeles'),
(6, 'Alaska Time', ' America/Anchorage'),
(7, 'Hawaii DST Time', ' America/Adak'),
(8, 'Hawaii Time', ' Pacific/Honolulu');

-- --------------------------------------------------------

--
-- Table structure for table `time_zone_name`
--

CREATE TABLE `time_zone_name` (
  `id` int(10) NOT NULL,
  `zone_name` varchar(100) NOT NULL,
  `zone_code` varchar(255) NOT NULL,
  `time_zone_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_zone_name`
--

INSERT INTO `time_zone_name` (`id`, `zone_name`, `zone_code`, `time_zone_id`) VALUES
(1, 'Alaska Standard Time', 'AKST', 'alaska'),
(2, 'Central Standard Time', 'CST', 'central'),
(3, 'Eastern Standard Time', 'EST', 'eastern'),
(4, 'Hawaii Standard Time', 'HST', 'hawai'),
(5, 'Mountain Standard Time', 'MST', 'mountain'),
(6, 'Pacific Standard Time', 'PST', 'pacific');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_shortname` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_role` int(255) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_password` text NOT NULL,
  `user_pass_status` tinyint(1) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `user_sec_profile` int(10) NOT NULL,
  `user_timezone` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_shortname`, `user_email`, `user_role`, `user_uid`, `user_password`, `user_pass_status`, `user_status`, `user_sec_profile`, `user_timezone`) VALUES
(1, 'Julio', 'Rosales', 'Julio r', 'julio.r@spotloan.com', 1, 'julior', '$2y$10$dy8CG0A9eFQfUPiC43XMnuDxTmw9e.8d6Ar3X98AK5SwuLYN4lq2W', 1, 1, 1, '4'),
(96, 'yosie', 'murillo', 'yosie m', 'yosie.m@spotloan.com', 5, 'yosiem', '$2y$10$Uq.3CvJw0jtFKpGXNVYtIexzsM/rDMiaxj4y866tMsvY9PFnOd8Dm', 0, 1, 5, '4'),
(97, 'RM', 'agent', 'RM a', 'rm.a@spotloan.com', 9, 'rma', '$2y$10$8Gi72U3JiA.FvJsr.8rM4.GDFC2lC/n6c9Qgbw0clCOTocLIpYzkq', 0, 1, 5, '4'),
(98, 'john', 'douglas', 'john d', 'john.d@spotloan.com', 2, 'johnd', '$2y$10$yAWX7tVXBjkTvDpDfDN4Y.1HYYZwzpY2tBbabFRJiyZolsku5dZaa', 0, 1, 2, '4'),
(99, 'jose', 'Martinez', 'jose M', 'jose.m@spotloan.com', 1, 'josem', '$2y$10$84B3HXWddVVrJDGYerMW1u1U2YS.auSH2OOg/2t4zIrmRUGYKqnfK', 0, 0, 2, '4');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(255) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_name`) VALUES
(1, 'Contact Center Supervisor'),
(2, 'Collections Specialist'),
(3, 'Investigations Agent'),
(4, 'Debt Settlement Agent'),
(5, 'Customer Service Representative'),
(6, 'Servicing Agent'),
(7, 'Investigations Supervisor'),
(8, 'Quality Assurance'),
(9, 'Customer Email Support Agent'),
(10, 'Account Review Specialist');

-- --------------------------------------------------------

--
-- Table structure for table `vacations`
--

CREATE TABLE `vacations` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `reqType` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `status` smallint(6) NOT NULL,
  `updater` smallint(6) NOT NULL,
  `updatedate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ach_return_codes`
--
ALTER TABLE `ach_return_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `debtsalebuyers`
--
ALTER TABLE `debtsalebuyers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`em_id`);

--
-- Indexes for table `emtype`
--
ALTER TABLE `emtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `em_cat`
--
ALTER TABLE `em_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sec_profile`
--
ALTER TABLE `sec_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicing_states`
--
ALTER TABLE `servicing_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soldlist`
--
ALTER TABLE `soldlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Loan_ID` (`Loan_ID`);

--
-- Indexes for table `sp_contact`
--
ALTER TABLE `sp_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_time_zone`
--
ALTER TABLE `state_time_zone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_zones`
--
ALTER TABLE `time_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_zone_name`
--
ALTER TABLE `time_zone_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_email_2` (`user_email`,`user_uid`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `vacations`
--
ALTER TABLE `vacations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `debtsalebuyers`
--
ALTER TABLE `debtsalebuyers`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `em_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emtype`
--
ALTER TABLE `emtype`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `em_cat`
--
ALTER TABLE `em_cat`
  MODIFY `cat_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sec_profile`
--
ALTER TABLE `sec_profile`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `servicing_states`
--
ALTER TABLE `servicing_states`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `soldlist`
--
ALTER TABLE `soldlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sp_contact`
--
ALTER TABLE `sp_contact`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `state_time_zone`
--
ALTER TABLE `state_time_zone`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `time_zones`
--
ALTER TABLE `time_zones`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `time_zone_name`
--
ALTER TABLE `time_zone_name`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vacations`
--
ALTER TABLE `vacations`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
