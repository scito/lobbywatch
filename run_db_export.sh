#!/bin/bash

# Include common functions
. common.sh

enable_fail_onerror

PHP='php'
LS='ls -Alh'

test_parameter=''
export_options=''

# http://stackoverflow.com/questions/192249/how-do-i-parse-command-line-arguments-in-bash
while test $# -gt 0; do
    case $1 in
        -h|--help)
            echo "Export Lobbywatch DB"
            echo
            echo "$0 [options]"
            echo
            echo "Options:"
            echo "-e LIST                          Type of data to export, add this type of data -e=hist, -e=intern, -e=unpubl, -e=hist+unpubl+intern (default: filter at most)"
            echo "-t, --test                       Test mode (limit number of records)"
            echo "-r, --refresh                    Refresh views"
            echo "-a, --automatic                  Automatic"
            echo "-v [LEVEL], --verbose [LEVEL]    Verbose mode (Default level=1)"
            echo "-l=DB, --local=DB                Local DB to use (Default: lobbywatchtest)"
            quit
        ;;
        -r|--refresh)
            refresh="-r"
            shift
        ;;
        -t|--test)
            test_parameter="-n"
            shift
        ;;
        -e)
            export_options=$2
            shift
            shift
        ;;
        -v|--verbose)
            verbose=true
            if [[ $2 =~ ^-?[0-9]+$ ]]; then
                verbose_level=$2
                verbose_mode="-v=$verbose_level"
                shift
            else
                verbose_level=1
            fi
            shift
        ;;
        -l=*|--local=*)
            db="${1#*=}"
            if [[ $db == "" ]]; then
                db="lobbywatchtest"
            fi
            env="local_${db}"
            shift
        ;;
        *)
            break
        ;;
    esac
done

checkLocalMySQLRunning

# if $import ; then
#   if ! $automatic ; then
#     askContinueYn "Import 'prod_bak/`cat $DUMP_FILE`' to LOCAL '$db' on '$HOSTNAME'?"
#   fi
# fi

START_OVERALL=$(date +%s)

export_type=''
if [ "$export_options" != "" ];then
    export_type="_$export_options"
fi

echo -e "$(date +%T) Start exporting..."

$PHP -f db_export.php -- -c -s -v -e=$export_options $test_parameter

echo -e "\n$(date +%T) Start packing..."

EXPORT=export
MERKBLATT="docs/lobbywatch_daten_merkblatt.pdf"

format=csv
base_name=lobbywatch_export_all
echo -e "\nPack $base_name.$format"
archive_with_date=$EXPORT/${DATE_SHORT}_$base_name$export_type.$format.zip
archive=$EXPORT/$base_name$export_type.$format.zip
[ -f "$archive_with_date" ] && rm $archive_with_date
zip $archive_with_date $MERKBLATT $EXPORT/*.$format
cp $archive_with_date $archive
$LS $archive_with_date $archive

base_name=lobbywatch_export_flat
echo -e "\nPack $base_name.$format"
archive_with_date=$EXPORT/${DATE_SHORT}_$base_name$export_type.$format.zip
archive=$EXPORT/$base_name$export_type.$format.zip
[ -f "$archive_with_date" ] && rm $archive_with_date
zip $archive_with_date $MERKBLATT $EXPORT/flat*.$format
cp $archive_with_date $archive
$LS $archive_with_date $archive

base_name=lobbywatch_export_parlamentarier
echo -e "\nPack $base_name.$format"
archive_with_date=$EXPORT/${DATE_SHORT}_$base_name$export_type.$format.zip
archive=$EXPORT/$base_name$export_type.$format.zip
[ -f "$archive_with_date" ] && rm $archive_with_date
zip $archive_with_date $MERKBLATT $EXPORT/cartesian_essential_parlamentarier_interessenbindung.csv $EXPORT/cartesian_minimal_parlamentarier_interessenbindung.csv $EXPORT/cartesian_parlamentarier_verguetungstransparenz.csv $EXPORT/cartesian_minimal_parlamentarier_zutrittsberechtigung.csv $EXPORT/cartesian_minimal_parlamentarier_zutrittsberechtigung_mandat.csv
cp $archive_with_date $archive
$LS $archive_with_date $archive

base_name=lobbywatch_export_parlamentarier_transparenzliste
echo -e "\nPack $base_name.$format"
archive_with_date=$EXPORT/${DATE_SHORT}_$base_name$export_type.$format.zip
archive=$EXPORT/$base_name$export_type.$format.zip
[ -f "$archive_with_date" ] && rm $archive_with_date
zip $archive_with_date $MERKBLATT $EXPORT/cartesian_parlamentarier_verguetungstransparenz.csv
cp $archive_with_date $archive
$LS $archive_with_date $archive

format=sql
base_name=lobbywatch
echo -e "\nPack $base_name.$format"
archive_with_date=$EXPORT/${DATE_SHORT}_$base_name$export_type.$format.zip
archive=$EXPORT/$base_name$export_type.$format.zip
[ -f "$archive_with_date" ] && rm $archive_with_date
zip $archive_with_date $MERKBLATT $EXPORT/*.$format
cp $archive_with_date $archive
$LS $archive_with_date $archive

END_OVERALL=$(date +%s)
DIFF=$(( $END_OVERALL - $START_OVERALL ))
echo -e "\n$(date +%T)" "Overall elapsed:" $(convertsecs $DIFF) "(${DIFF}s)"

quit
