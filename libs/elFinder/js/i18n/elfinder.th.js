/**
 *  translation
 * @version 2024-09-26
 */
(function (root, factory) {
  if (typeof define === "function" && define.amd) {
    define(["elfinder"], factory);
  } else if (typeof exports !== "undefined") {
    module.exports = factory(require("elfinder"));
  } else {
    factory(root.elFinder);
  }
})(this, function (elFinder) {
  elFinder.prototype.i18.th = {
    translator: "Thailand",
    language: "th",
    direction: "ltr",
    dateFormat: "d M Y h:i A", // will show like: ก.ย. 26, 2024 08:34 PM
    fancyDateFormat: "$1 h:i A", // will show like: วันนี้ 08:34 PM
    nonameDateFormat: "dmy-His", // noname upload will show like: 240926-203451
    messages: {
      /********************************** errors **********************************/
      error: "ข้อผิดพลาด",
      errUnknown: "ข้อผิดพลาดที่ไม่รู้จัก",
      errUnknownCmd: "คำสั่งที่ไม่รู้จัก",
      errJqui:
        "การกำหนดค่า jQuery UI ไม่ถูกต้อง จะต้องรวมส่วนประกอบที่เลือกได้ ลากและวางได้",
      errNode: "elFinder กำหนดให้สร้างองค์ประกอบ DOM",
      errURL: "การกำหนดค่า elFinder ไม่ถูกต้อง! ไม่ได้ตั้งค่าตัวเลือก URL",
      errAccess: "การเข้าถึงถูกปฏิเสธ",
      errConnect: "ไม่สามารถเชื่อมต่อกับแบ็กเอนด์ได้",
      errAbort: "การเชื่อมต่อถูกยกเลิก",
      errTimeout: "หมดเวลาการเชื่อมต่อ",
      errNotFound: "ไม่พบ Backend",
      errResponse: "การตอบสนอง Backend ไม่ถูกต้อง",
      errConf: "การกำหนดค่า Backend ไม่ถูกต้อง",
      errJSON: "ไม่ได้ติดตั้งโมดูล PHP JSON",
      errNoVolumes: "ไม่มีปริมาณที่สามารถอ่านได้",
      errCmdParams: 'พารามิเตอร์ไม่ถูกต้องสำหรับคำสั่ง "$1"',
      errDataNotJSON: "ข้อมูลไม่ใช่ JSON",
      errDataEmpty: "ข้อมูลว่างเปล่า",
      errCmdReq: "คำขอ Backend ต้องใช้ชื่อคำสั่ง",
      errOpen: 'ไม่สามารถเปิด "$1"',
      errNotFolder: "วัตถุไม่ใช่โฟลเดอร์",
      errNotFile: "วัตถุไม่ใช่ไฟล์",
      errRead: 'ไม่สามารถอ่าน "$1"',
      errWrite: 'ไม่สามารถเขียนลงใน "$1"',
      errPerm: "การอนุญาตถูกปฏิเสธ",
      errLocked: '"$1" ถูกล็อค และไม่สามารถเปลี่ยนชื่อ ย้าย หรือลบออกได้',
      errExists: 'มีรายการชื่อ "$1" อยู่แล้ว',
      errInvName: "ชื่อไฟล์ไม่ถูกต้อง",
      errInvDirname: "ชื่อโฟลเดอร์ไม่ถูกต้อง", // from v2.1.24 added 12.4.2017
      errFolderNotFound: "ไม่พบโฟลเดอร์",
      errFileNotFound: "ไม่พบไฟล์",
      errTrgFolderNotFound: 'ไม่พบโฟลเดอร์เป้าหมาย "$1"',
      errPopup:
        "เบราว์เซอร์ป้องกันการเปิดหน้าต่างป๊อปอัป หากต้องการเปิดไฟล์ให้เปิดใช้งานในตัวเลือกเบราว์เซอร์",
      errMkdir: 'ไม่สามารถสร้างโฟลเดอร์ "$1" ได้',
      errMkfile: 'ไม่สามารถสร้างไฟล์ "$1" ได้',
      errRename: 'ไม่สามารถเปลี่ยนชื่อ "$1" ได้',
      errCopyFrom: 'ไม่อนุญาตให้คัดลอกไฟล์จากวอลุ่ม "$1"',
      errCopyTo: 'ไม่อนุญาตให้คัดลอกไฟล์ไปที่โวลุ่ม "$1"',
      errMkOutLink: "ไม่สามารถสร้างลิงก์ไปยังภายนอกรูทวอลุ่มได้", // from v2.1 added 03.10.2015
      errUpload: "ข้อผิดพลาดในการอัปโหลด", // old name - errUploadCommon
      errUploadFile: 'ไม่สามารถอัปโหลด "$1"', // old name - errUpload
      errUploadNoFiles: "ไม่พบไฟล์ที่จะอัพโหลด",
      errUploadTotalSize: "ข้อมูลเกินขนาดสูงสุดที่อนุญาต", // old name - errMaxSize
      errUploadFileSize: "ไฟล์มีขนาดเกินขนาดสูงสุดที่อนุญาต", //  old name - errFileMaxSize
      errUploadMime: "ไม่อนุญาตให้ใช้ประเภทไฟล์",
      errUploadTransfer: 'ข้อผิดพลาดในการโอน "$1"',
      errUploadTemp: "ไม่สามารถสร้างไฟล์ชั่วคราวเพื่ออัพโหลดได้", // from v2.1 added 26.09.2015
      errNotReplace:
        'มีวัตถุ "$1" อยู่แล้วที่ตำแหน่งนี้ และไม่สามารถแทนที่ด้วยวัตถุประเภทอื่นได้', // new
      errReplace: 'ไม่สามารถแทนที่ "$1" ได้',
      errSave: 'ไม่สามารถบันทึก "$1" ได้',
      errCopy: 'ไม่สามารถคัดลอก "$1"',
      errMove: 'ไม่สามารถย้าย "$1"',
      errCopyInItself: 'ไม่สามารถคัดลอก "$1" ลงในตัวมันเองได้',
      errRm: 'ไม่สามารถลบ "$1" ได้',
      errTrash: "ไม่สามารถลงถังขยะได้", // from v2.1.24 added 30.4.2017
      errRmSrc: "ไม่สามารถลบไฟล์ต้นฉบับได้",
      errExtract: 'ไม่สามารถแยกไฟล์จาก "$1"',
      errArchive: "ไม่สามารถสร้างที่เก็บถาวรได้",
      errArcType: "ประเภทไฟล์เก็บถาวรที่ไม่รองรับ",
      errNoArchive:
        "ไฟล์ไม่ใช่ไฟล์เก็บถาวรหรือมีประเภทไฟล์เก็บถาวรที่ไม่รองรับ",
      errCmdNoSupport: "แบ็กเอนด์ไม่รองรับคำสั่งนี้",
      errReplByChild: 'โฟลเดอร์ "$1" ไม่สามารถแทนที่ด้วยรายการที่มีอยู่ได้',
      errArcSymlinks:
        "ด้วยเหตุผลด้านความปลอดภัย ไม่อนุญาตให้คลายไฟล์เก็บถาวรที่มีลิงก์สัญลักษณ์หรือไฟล์ที่มีชื่อที่ไม่ได้รับอนุญาต", // edited 24.06.2012
      errArcMaxSize: "ไฟล์เก็บถาวรเกินขนาดสูงสุดที่อนุญาต",
      errResize: 'ไม่สามารถปรับขนาด "$1"',
      errResizeDegree: "องศาการหมุนไม่ถูกต้อง", // added 7.3.2013
      errResizeRotate: "ไม่สามารถหมุนภาพได้", // added 7.3.2013
      errResizeSize: "ขนาดรูปภาพไม่ถูกต้อง", // added 7.3.2013
      errResizeNoChange: "ขนาดภาพไม่เปลี่ยนแปลง", // added 7.3.2013
      errUsupportType: "ประเภทไฟล์ที่ไม่รองรับ",
      errNotUTF8Content:
        'ไฟล์ "$1" ไม่ได้อยู่ในรูปแบบ UTF-8 และไม่สามารถแก้ไขได้', // added 9.11.2011
      errNetMount: 'ไม่สามารถต่อเชื่อม "$1" ได้', // added 17.04.2012
      errNetMountNoDriver: "โปรโตคอลที่ไม่รองรับ", // added 17.04.2012
      errNetMountFailed: "เมานต์ล้มเหลว", // added 17.04.2012
      errNetMountHostReq: "จำเป็นต้องมีโฮสต์", // added 18.04.2012
      errSessionExpires: "เซสชันของคุณหมดอายุเนื่องจากไม่มีการใช้งาน",
      errCreatingTempDir: 'ไม่สามารถสร้างไดเรกทอรีชั่วคราว: "$1"',
      errFtpDownloadFile: 'ไม่สามารถดาวน์โหลดไฟล์จาก FTP: "$1"',
      errFtpUploadFile: 'ไม่สามารถอัปโหลดไฟล์ไปยัง FTP: "$1"',
      errFtpMkdir: 'ไม่สามารถสร้างไดเรกทอรีระยะไกลบน FTP: "$1"',
      errArchiveExec: 'เกิดข้อผิดพลาดขณะเก็บถาวรไฟล์: "$1"',
      errExtractExec: 'เกิดข้อผิดพลาดขณะเก็บถาวรไฟล์: "$1"',
      errNetUnMount: "ไม่สามารถยกเลิกการต่อเชื่อมได้", // from v2.1 added 30.04.2012
      errConvUTF8: "ไม่สามารถแปลงเป็น UTF-8 ได้", // from v2.1 added 08.04.2014
      errFolderUpload: "ลองใช้เบราว์เซอร์รุ่นใหม่ หากคุณต้องการอัปโหลดโฟลเดอร์", // from v2.1 added 26.6.2015
      errSearchTimeout: 'หมดเวลาขณะค้นหา "$1" ผลการค้นหาเป็นบางส่วน', // from v2.1 added 12.1.2016
      errReauthRequire: "จำเป็นต้องได้รับอนุญาตอีกครั้ง", // from v2.1.10 added 24.3.2016
      errMaxTargets: "จำนวนรายการที่สามารถเลือกได้สูงสุดคือ $1", // from v2.1.17 added 17.10.2016
      errRestore:
        "ไม่สามารถกู้คืนจากถังขยะได้ ไม่สามารถระบุปลายทางการคืนค่าได้", // from v2.1.24 added 3.5.2017
      errEditorNotFound: "ไม่พบตัวแก้ไขสำหรับไฟล์ประเภทนี้", // from v2.1.25 added 23.5.2017
      errServerError: "เกิดข้อผิดพลาดในฝั่งเซิร์ฟเวอร์", // from v2.1.25 added 16.6.2017
      errEmpty: 'ไม่สามารถล้างโฟลเดอร์ "$1" ได้', // from v2.1.25 added 22.6.2017
      moreErrors: "มีข้อผิดพลาดอีก $1", // from v2.1.44 added 9.12.2018
      errMaxMkdirs: "คุณสามารถสร้างโฟลเดอร์ได้สูงสุด $1 โฟลเดอร์ต่อครั้ง", // from v2.1.58 added 20.6.2021

      /******************************* commands names ********************************/
      cmdarchive: "สร้างที่เก็บถาวร",
      cmdback: "ย้อนกลับ",
      cmdcopy: "คัดลอก",
      cmdcut: "ตัด",
      cmddownload: "ดาวน์โหลด",
      cmdduplicate: "ทำซ้ำ",
      cmdedit: "แก้ไขไฟล์",
      cmdextract: "แตกไฟล์",
      cmdforward: "ไปหน้าถัดไป",
      cmdgetfile: "เลือกไฟล์",
      cmdhelp: "เกี่ยวกับซอฟต์แวร์นี้",
      cmdhome: "Root",
      cmdinfo: "รับข้อมูล",
      cmdmkdir: "สร้างโฟลเดอร์ใหม่",
      cmdmkdirin: "นำเข้าโฟลเดอร์ใหม่", // from v2.1.7 added 19.2.2016
      cmdmkfile: "สร้างไฟล์ใหม่",
      cmdopen: "เปิด",
      cmdpaste: "วาง",
      cmdquicklook: "เปิดดู",
      cmdreload: "รีโหลด",
      cmdrename: "เปลี่ยนชื่อ",
      cmdrm: "ลบ",
      cmdtrash: "นำลงถังขยะ", //from v2.1.24 added 29.4.2017
      cmdrestore: "คืนค่า", //from v2.1.24 added 3.5.2017
      cmdsearch: "ค้นหาไฟล์",
      cmdup: "ไปที่โฟลเดอร์หลัก",
      cmdupload: "อัพโหลดไฟล์",
      cmdview: "เปิดดู",
      cmdresize: "ปรับขนาดและหมุน",
      cmdsort: "เรียงลำดับ",
      cmdnetmount: "Mount network volume", // added 18.04.2012
      cmdnetunmount: "Unmount", // from v2.1 added 30.04.2012
      cmdplaces: "To Places", // added 28.12.2014
      cmdchmod: "เปลี่ยนโหลด", // from v2.1 added 20.6.2015
      cmdopendir: "เปิดโฟลเดอร์", // from v2.1 added 13.1.2016
      cmdcolwidth: "รีเซ็ตความกว้างของคอลัมน์", // from v2.1.13 added 12.06.2016
      cmdfullscreen: "เต็มจอ", // from v2.1.15 added 03.08.2016
      cmdmove: "ย้าย", // from v2.1.15 added 21.08.2016
      cmdempty: "Empty the folder", // from v2.1.25 added 22.06.2017
      cmdundo: "ย้อนกลับ", // from v2.1.27 added 31.07.2017
      cmdredo: "ลองอีกครั้ง", // from v2.1.27 added 31.07.2017
      cmdpreference: "การตั้งค่า", // from v2.1.27 added 03.08.2017
      cmdselectall: "เลือกทั้งหมด", // from v2.1.28 added 15.08.2017
      cmdselectnone: "Select none", // from v2.1.28 added 15.08.2017
      cmdselectinvert: "สลับการเลือก", // from v2.1.28 added 15.08.2017
      cmdopennew: "เปิดในหน้าต่างใหม่", // from v2.1.38 added 3.4.2018
      cmdhide: "ซ่อน (การตั้งค่า)", // from v2.1.41 added 24.7.2018

      /*********************************** buttons ***********************************/
      btnClose: "ปิด",
      btnSave: "บันทึก",
      btnRm: "ลบ",
      btnApply: "ตกลก",
      btnCancel: "ยกเลิก",
      btnNo: "ไม่",
      btnYes: "ใช่",
      btnMount: "Mount", // added 18.04.2012
      btnApprove: "ไปที่ $1 และอนุมัติ", // from v2.1 added 26.04.2012
      btnUnmount: "Unmount", // from v2.1 added 30.04.2012
      btnConv: "แปลง", // from v2.1 added 08.04.2014
      btnCwd: "Here", // from v2.1 added 22.5.2015
      btnVolume: "Volume", // from v2.1 added 22.5.2015
      btnAll: "ทั้งหมด", // from v2.1 added 22.5.2015
      btnMime: "MIME Type", // from v2.1 added 22.5.2015
      btnFileName: "ชื่อไฟล์", // from v2.1 added 22.5.2015
      btnSaveClose: "บันทึกและปิด", // from v2.1 added 12.6.2015
      btnBackup: "สำรองข้อมูล", // fromv2.1 added 28.11.2015
      btnRename: "เปลี่ยนชื่อ", // from v2.1.24 added 6.4.2017
      btnRenameAll: "เปลี่ยนชื่อ(ทั้งหมด)", // from v2.1.24 added 6.4.2017
      btnPrevious: "Prev ($1/$2)", // from v2.1.24 added 11.5.2017
      btnNext: "Next ($1/$2)", // from v2.1.24 added 11.5.2017
      btnSaveAs: "บันทึกเป็น", // from v2.1.25 added 24.5.2017

      /******************************** notifications ********************************/
      ntfopen: "เปิดโฟลเดอร์",
      ntffile: "เปิดไฟล์",
      ntfreload: "โหลดเนื้อหาโฟลเดอร์ซ้ำ",
      ntfmkdir: "กำลังสร้างโฟลเดอร์",
      ntfmkfile: "การสร้างไฟล์",
      ntfrm: "ลบรายการ",
      ntfcopy: "คัดลอกรายการ",
      ntfmove: "ย้ายรายการ",
      ntfprepare: "กำลังตรวจสอบรายการที่มีอยู่",
      ntfrename: "เปลี่ยนชื่อไฟล์",
      ntfupload: "เปลี่ยนชื่อไฟล์",
      ntfdownload: "ดาวน์โหลดไฟล์",
      ntfsave: "บันทึกไฟล์",
      ntfarchive: "Creating archive",
      ntfextract: "Extracting files from archive",
      ntfsearch: "กำลังค้นหาไฟล์",
      ntfresize: "การปรับขนาดรูปภาพ",
      ntfsmth: "กำลังทำอะไรสักอย่าง",
      ntfloadimg: "กำลังโหลดรูปภาพ",
      ntfnetmount: "Mounting network volume", // added 18.04.2012
      ntfnetunmount: "Unmounting network volume", // from v2.1 added 30.04.2012
      ntfdim: "Acquiring image dimension", // added 20.05.2013
      ntfreaddir: "Reading folder infomation", // from v2.1 added 01.07.2013
      ntfurl: "Getting URL of link", // from v2.1 added 11.03.2014
      ntfchmod: "Changing file mode", // from v2.1 added 20.6.2015
      ntfpreupload: "Verifying upload file name", // from v2.1 added 31.11.2015
      ntfzipdl: "Creating a file for download", // from v2.1.7 added 23.1.2016
      ntfparents: "Getting path infomation", // from v2.1.17 added 2.11.2016
      ntfchunkmerge: "Processing the uploaded file", // from v2.1.17 added 2.11.2016
      ntftrash: "Doing throw in the trash", // from v2.1.24 added 2.5.2017
      ntfrestore: "Doing restore from the trash", // from v2.1.24 added 3.5.2017
      ntfchkdir: "Checking destination folder", // from v2.1.24 added 3.5.2017
      ntfundo: "Undoing previous operation", // from v2.1.27 added 31.07.2017
      ntfredo: "Redoing previous undone", // from v2.1.27 added 31.07.2017
      ntfchkcontent: "Checking contents", // from v2.1.41 added 3.8.2018

      /*********************************** volumes *********************************/
      volume_Trash: "Trash", //from v2.1.24 added 29.4.2017

      /************************************ dates **********************************/
      dateUnknown: "unknown",
      Today: "วันนี้",
      Yesterday: "เมื่อวาน",
      msJan: "ม.ค.",
      msFeb: "ก.พ.",
      msMar: "มี.ค.",
      msApr: "เม.ย.",
      msMay: "พ.ค.",
      msJun: "มิ.ย.",
      msJul: "ก.ค.",
      msAug: "ส.ค.",
      msSep: "ก.ย.",
      msOct: "ต.ค.",
      msNov: "พ.ย.",
      msDec: "ธ.ค.",
      January: "มกราคม",
      February: "กุมภาพันธ์",
      March: "มีนาคม",
      April: "เมษายน",
      May: "พฤษภาคม",
      June: "มิถุนายน",
      July: "มิถุนายน",
      August: "สิงหาคม",
      September: "กันยายน",
      October: "ตุลาคม",
      November: "พฤศจิกายน",
      December: "ธันวาคม",
      Sunday: "วันอาทิตย์",
      Monday: "วันจันทร์",
      Tuesday: "วันอังคาร",
      Wednesday: "วันพุธ",
      Thursday: "วันพฤหัสบดี",
      Friday: "วันศุกร์",
      Saturday: "วันเสาร์",
      Sun: "วันอาทิตย์",
      Mon: "วันจันทร์",
      Tue: "วันอังคาร",
      Wed: "วันพุธ",
      Thu: "วันพฤหัสบดี",
      Fri: "วันศุกร์",
      Sat: "วันเสาร์",

      /******************************** sort variants ********************************/
      sortname: "by name",
      sortkind: "by kind",
      sortsize: "by size",
      sortdate: "by date",
      sortFoldersFirst: "Folders first",
      sortperm: "by permission", // from v2.1.13 added 13.06.2016
      sortmode: "by mode", // from v2.1.13 added 13.06.2016
      sortowner: "by owner", // from v2.1.13 added 13.06.2016
      sortgroup: "by group", // from v2.1.13 added 13.06.2016
      sortAlsoTreeview: "Also Treeview", // from v2.1.15 added 01.08.2016

      /********************************** new items **********************************/
      "untitled file.txt": "NewFile.txt", // added 10.11.2015
      "untitled folder": "NewFolder", // added 10.11.2015
      Archive: "NewArchive", // from v2.1 added 10.11.2015
      "untitled file": "NewFile.$1", // from v2.1.41 added 6.8.2018
      extentionfile: "$1: File", // from v2.1.41 added 6.8.2018
      extentiontype: "$1: $2", // from v2.1.43 added 17.10.2018

      /********************************** messages **********************************/
      confirmReq: "Confirmation required",
      confirmRm:
        "Are you sure you want to permanently remove items?<br/>This cannot be undone!",
      confirmRepl:
        "Replace old file with new one? (If it contains folders, it will be merged. To backup and replace, select Backup.)",
      confirmRest: "Replace existing item with the item in trash?", // fromv2.1.24 added 5.5.2017
      confirmConvUTF8:
        "Not in UTF-8<br/>Convert to UTF-8?<br/>Contents become UTF-8 by saving after conversion.", // from v2.1 added 08.04.2014
      confirmNonUTF8:
        "Character encoding of this file couldn't be detected. It need to temporarily convert to UTF-8 for editting.<br/>Please select character encoding of this file.", // from v2.1.19 added 28.11.2016
      confirmNotSave:
        "It has been modified.<br/>Losing work if you do not save changes.", // from v2.1 added 15.7.2015
      confirmTrash: "Are you sure you want to move items to trash bin?", //from v2.1.24 added 29.4.2017
      confirmMove: 'Are you sure you want to move items to "$1"?', //from v2.1.50 added 27.7.2019
      apllyAll: "Apply to all",
      name: "Name",
      size: "Size",
      perms: "Permissions",
      modify: "Modified",
      kind: "Kind",
      read: "read",
      write: "write",
      noaccess: "no access",
      and: "and",
      unknown: "unknown",
      selectall: "Select all items",
      selectfiles: "Select item(s)",
      selectffile: "Select first item",
      selectlfile: "Select last item",
      viewlist: "List view",
      viewicons: "Icons view",
      viewSmall: "Small icons", // from v2.1.39 added 22.5.2018
      viewMedium: "Medium icons", // from v2.1.39 added 22.5.2018
      viewLarge: "Large icons", // from v2.1.39 added 22.5.2018
      viewExtraLarge: "Extra large icons", // from v2.1.39 added 22.5.2018
      places: "Places",
      calc: "Calculate",
      path: "Path",
      aliasfor: "Alias for",
      locked: "Locked",
      dim: "Dimensions",
      files: "Files",
      folders: "Folders",
      items: "Items",
      yes: "yes",
      no: "no",
      link: "Link",
      searcresult: "Search results",
      selected: "selected items",
      about: "About",
      shortcuts: "Shortcuts",
      help: "Help",
      webfm: "Web file manager",
      ver: "Version",
      protocolver: "protocol version",
      homepage: "Project home",
      docs: "Documentation",
      github: "Fork us on GitHub",
      twitter: "Follow us on Twitter",
      facebook: "Join us on Facebook",
      team: "Team",
      chiefdev: "chief developer",
      developer: "developer",
      contributor: "contributor",
      maintainer: "maintainer",
      translator: "translator",
      icons: "Icons",
      dontforget: "and don't forget to take your towel",
      shortcutsof: "Shortcuts disabled",
      dropFiles: "Drop files here",
      or: "or",
      selectForUpload: "Select files",
      moveFiles: "Move items",
      copyFiles: "Copy items",
      restoreFiles: "Restore items", // from v2.1.24 added 5.5.2017
      rmFromPlaces: "Remove from places",
      aspectRatio: "Aspect ratio",
      scale: "Scale",
      width: "Width",
      height: "Height",
      resize: "Resize",
      crop: "Crop",
      rotate: "Rotate",
      "rotate-cw": "Rotate 90 degrees CW",
      "rotate-ccw": "Rotate 90 degrees CCW",
      degree: "°",
      netMountDialogTitle: "Mount network volume", // added 18.04.2012
      protocol: "Protocol", // added 18.04.2012
      host: "Host", // added 18.04.2012
      port: "Port", // added 18.04.2012
      user: "User", // added 18.04.2012
      pass: "Password", // added 18.04.2012
      confirmUnmount: "Are you unmount $1?", // from v2.1 added 30.04.2012
      dropFilesBrowser: "Drop or Paste files from browser", // from v2.1 added 30.05.2012
      dropPasteFiles: "Drop files, Paste URLs or images(clipboard) here", // from v2.1 added 07.04.2014
      encoding: "Encoding", // from v2.1 added 19.12.2014
      locale: "Locale", // from v2.1 added 19.12.2014
      searchTarget: "Target: $1", // from v2.1 added 22.5.2015
      searchMime: "Search by input MIME Type", // from v2.1 added 22.5.2015
      owner: "Owner", // from v2.1 added 20.6.2015
      group: "Group", // from v2.1 added 20.6.2015
      other: "Other", // from v2.1 added 20.6.2015
      execute: "Execute", // from v2.1 added 20.6.2015
      perm: "Permission", // from v2.1 added 20.6.2015
      mode: "Mode", // from v2.1 added 20.6.2015
      emptyFolder: "Folder is empty", // from v2.1.6 added 30.12.2015
      emptyFolderDrop: "Folder is empty\\A Drop to add items", // from v2.1.6 added 30.12.2015
      emptyFolderLTap: "Folder is empty\\A Long tap to add items", // from v2.1.6 added 30.12.2015
      quality: "Quality", // from v2.1.6 added 5.1.2016
      autoSync: "Auto sync", // from v2.1.6 added 10.1.2016
      moveUp: "Move up", // from v2.1.6 added 18.1.2016
      getLink: "Get URL link", // from v2.1.7 added 9.2.2016
      selectedItems: "Selected items ($1)", // from v2.1.7 added 2.19.2016
      folderId: "Folder ID", // from v2.1.10 added 3.25.2016
      offlineAccess: "Allow offline access", // from v2.1.10 added 3.25.2016
      reAuth: "To re-authenticate", // from v2.1.10 added 3.25.2016
      nowLoading: "Now loading...", // from v2.1.12 added 4.26.2016
      openMulti: "Open multiple files", // from v2.1.12 added 5.14.2016
      openMultiConfirm:
        "You are trying to open the $1 files. Are you sure you want to open in browser?", // from v2.1.12 added 5.14.2016
      emptySearch: "Search results is empty in search target.", // from v2.1.12 added 5.16.2016
      editingFile: "It is editing a file.", // from v2.1.13 added 6.3.2016
      hasSelected: "You have selected $1 items.", // from v2.1.13 added 6.3.2016
      hasClipboard: "You have $1 items in the clipboard.", // from v2.1.13 added 6.3.2016
      incSearchOnly: "Incremental search is only from the current view.", // from v2.1.13 added 6.30.2016
      reinstate: "Reinstate", // from v2.1.15 added 3.8.2016
      complete: "$1 complete", // from v2.1.15 added 21.8.2016
      contextmenu: "Context menu", // from v2.1.15 added 9.9.2016
      pageTurning: "Page turning", // from v2.1.15 added 10.9.2016
      volumeRoots: "Volume roots", // from v2.1.16 added 16.9.2016
      reset: "Reset", // from v2.1.16 added 1.10.2016
      bgcolor: "Background color", // from v2.1.16 added 1.10.2016
      colorPicker: "Color picker", // from v2.1.16 added 1.10.2016
      "8pxgrid": "8px Grid", // from v2.1.16 added 4.10.2016
      enabled: "Enabled", // from v2.1.16 added 4.10.2016
      disabled: "Disabled", // from v2.1.16 added 4.10.2016
      emptyIncSearch:
        "Search results is empty in current view.\\APress [Enter] to expand search target.", // from v2.1.16 added 5.10.2016
      emptyLetSearch: "First letter search results is empty in current view.", // from v2.1.23 added 24.3.2017
      textLabel: "Text label", // from v2.1.17 added 13.10.2016
      minsLeft: "$1 mins left", // from v2.1.17 added 13.11.2016
      openAsEncoding: "Reopen with selected encoding", // from v2.1.19 added 2.12.2016
      saveAsEncoding: "Save with the selected encoding", // from v2.1.19 added 2.12.2016
      selectFolder: "Select folder", // from v2.1.20 added 13.12.2016
      firstLetterSearch: "First letter search", // from v2.1.23 added 24.3.2017
      presets: "Presets", // from v2.1.25 added 26.5.2017
      tooManyToTrash: "It's too many items so it can't into trash.", // from v2.1.25 added 9.6.2017
      TextArea: "TextArea", // from v2.1.25 added 14.6.2017
      folderToEmpty: 'Empty the folder "$1".', // from v2.1.25 added 22.6.2017
      filderIsEmpty: 'There are no items in a folder "$1".', // from v2.1.25 added 22.6.2017
      preference: "Preference", // from v2.1.26 added 28.6.2017
      language: "Language", // from v2.1.26 added 28.6.2017
      clearBrowserData: "Initialize the settings saved in this browser", // from v2.1.26 added 28.6.2017
      toolbarPref: "Toolbar settings", // from v2.1.27 added 2.8.2017
      charsLeft: "... $1 chars left.", // from v2.1.29 added 30.8.2017
      linesLeft: "... $1 lines left.", // from v2.1.52 added 16.1.2020
      sum: "Sum", // from v2.1.29 added 28.9.2017
      roughFileSize: "Rough file size", // from v2.1.30 added 2.11.2017
      autoFocusDialog: "Focus on the element of dialog with mouseover", // from v2.1.30 added 2.11.2017
      select: "Select", // from v2.1.30 added 23.11.2017
      selectAction: "Action when select file", // from v2.1.30 added 23.11.2017
      useStoredEditor: "Open with the editor used last time", // from v2.1.30 added 23.11.2017
      selectinvert: "Invert selection", // from v2.1.30 added 25.11.2017
      renameMultiple:
        "Are you sure you want to rename $1 selected items like $2?<br/>This cannot be undone!", // from v2.1.31 added 4.12.2017
      batchRename: "Batch rename", // from v2.1.31 added 8.12.2017
      plusNumber: "+ Number", // from v2.1.31 added 8.12.2017
      asPrefix: "Add prefix", // from v2.1.31 added 8.12.2017
      asSuffix: "Add suffix", // from v2.1.31 added 8.12.2017
      changeExtention: "Change extention", // from v2.1.31 added 8.12.2017
      columnPref: "Columns settings (List view)", // from v2.1.32 added 6.2.2018
      reflectOnImmediate:
        "All changes will reflect immediately to the archive.", // from v2.1.33 added 2.3.2018
      reflectOnUnmount:
        "Any changes will not reflect until un-mount this volume.", // from v2.1.33 added 2.3.2018
      unmountChildren:
        "The following volume(s) mounted on this volume also unmounted. Are you sure to unmount it?", // from v2.1.33 added 5.3.2018
      selectionInfo: "Selection Info", // from v2.1.33 added 7.3.2018
      hashChecker: "Algorithms to show the file hash", // from v2.1.33 added 10.3.2018
      infoItems: "Info Items (Selection Info Panel)", // from v2.1.38 added 28.3.2018
      pressAgainToExit: "Press again to exit.", // from v2.1.38 added 1.4.2018
      toolbar: "Toolbar", // from v2.1.38 added 4.4.2018
      workspace: "Work Space", // from v2.1.38 added 4.4.2018
      dialog: "Dialog", // from v2.1.38 added 4.4.2018
      all: "All", // from v2.1.38 added 4.4.2018
      iconSize: "Icon Size (Icons view)", // from v2.1.39 added 7.5.2018
      editorMaximized: "Open the maximized editor window", // from v2.1.40 added 30.6.2018
      editorConvNoApi:
        "Because conversion by API is not currently available, please convert on the website.", //from v2.1.40 added 8.7.2018
      editorConvNeedUpload:
        "After conversion, you must be upload with the item URL or a downloaded file to save the converted file.", //from v2.1.40 added 8.7.2018
      convertOn: "Convert on the site of $1", // from v2.1.40 added 10.7.2018
      integrations: "Integrations", // from v2.1.40 added 11.7.2018
      integrationWith:
        "This elFinder has the following external services integrated. Please check the terms of use, privacy policy, etc. before using it.", // from v2.1.40 added 11.7.2018
      showHidden: "Show hidden items", // from v2.1.41 added 24.7.2018
      hideHidden: "Hide hidden items", // from v2.1.41 added 24.7.2018
      toggleHidden: "Show/Hide hidden items", // from v2.1.41 added 24.7.2018
      makefileTypes: 'File types to enable with "New file"', // from v2.1.41 added 7.8.2018
      typeOfTextfile: "Type of the Text file", // from v2.1.41 added 7.8.2018
      add: "Add", // from v2.1.41 added 7.8.2018
      theme: "Theme", // from v2.1.43 added 19.10.2018
      default: "Default", // from v2.1.43 added 19.10.2018
      description: "Description", // from v2.1.43 added 19.10.2018
      website: "Website", // from v2.1.43 added 19.10.2018
      author: "Author", // from v2.1.43 added 19.10.2018
      email: "Email", // from v2.1.43 added 19.10.2018
      license: "License", // from v2.1.43 added 19.10.2018
      exportToSave:
        "This item can't be saved. To avoid losing the edits you need to export to your PC.", // from v2.1.44 added 1.12.2018
      dblclickToSelect: "Double click on the file to select it.", // from v2.1.47 added 22.1.2019
      useFullscreen: "ใช้งานเต็มจอ", // from v2.1.47 added 19.2.2019

      /********************************** mimetypes **********************************/
      kindUnknown: "Unknown",
      kindRoot: "Volume Root", // from v2.1.16 added 16.10.2016
      kindFolder: "Folder",
      kindSelects: "Selections", // from v2.1.29 added 29.8.2017
      kindAlias: "Alias",
      kindAliasBroken: "Broken alias",
      // applications
      kindApp: "Application",
      kindPostscript: "Postscript document",
      kindMsOffice: "Microsoft Office document",
      kindMsWord: "Microsoft Word document",
      kindMsExcel: "Microsoft Excel document",
      kindMsPP: "Microsoft Powerpoint presentation",
      kindOO: "Open Office document",
      kindAppFlash: "Flash application",
      kindPDF: "Portable Document Format (PDF)",
      kindTorrent: "Bittorrent file",
      kind7z: "7z archive",
      kindTAR: "TAR archive",
      kindGZIP: "GZIP archive",
      kindBZIP: "BZIP archive",
      kindXZ: "XZ archive",
      kindZIP: "ZIP archive",
      kindRAR: "RAR archive",
      kindJAR: "Java JAR file",
      kindTTF: "True Type font",
      kindOTF: "Open Type font",
      kindRPM: "RPM package",
      // texts
      kindText: "Text document",
      kindTextPlain: "Plain text",
      kindPHP: "PHP source",
      kindCSS: "Cascading style sheet",
      kindHTML: "HTML document",
      kindJS: "Javascript source",
      kindRTF: "Rich Text Format",
      kindC: "C source",
      kindCHeader: "C header source",
      kindCPP: "C++ source",
      kindCPPHeader: "C++ header source",
      kindShell: "Unix shell script",
      kindPython: "Python source",
      kindJava: "Java source",
      kindRuby: "Ruby source",
      kindPerl: "Perl script",
      kindSQL: "SQL source",
      kindXML: "XML document",
      kindAWK: "AWK source",
      kindCSV: "Comma separated values",
      kindDOCBOOK: "Docbook XML document",
      kindMarkdown: "Markdown text", // added 20.7.2015
      // images
      kindImage: "Image",
      kindBMP: "BMP image",
      kindJPEG: "JPEG image",
      kindGIF: "GIF Image",
      kindPNG: "PNG Image",
      kindTIFF: "TIFF image",
      kindTGA: "TGA image",
      kindPSD: "Adobe Photoshop image",
      kindXBITMAP: "X bitmap image",
      kindPXM: "Pixelmator image",
      // media
      kindAudio: "Audio media",
      kindAudioMPEG: "MPEG audio",
      kindAudioMPEG4: "MPEG-4 audio",
      kindAudioMIDI: "MIDI audio",
      kindAudioOGG: "Ogg Vorbis audio",
      kindAudioWAV: "WAV audio",
      AudioPlaylist: "MP3 playlist",
      kindVideo: "Video media",
      kindVideoDV: "DV movie",
      kindVideoMPEG: "MPEG movie",
      kindVideoMPEG4: "MPEG-4 movie",
      kindVideoAVI: "AVI movie",
      kindVideoMOV: "Quick Time movie",
      kindVideoWM: "Windows Media movie",
      kindVideoFlash: "Flash movie",
      kindVideoMKV: "Matroska movie",
      kindVideoOGG: "Ogg movie",
    },
  };
});
