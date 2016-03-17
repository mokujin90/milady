SELECT
  `t`.`id`,
  `t`.`user_id`,
  `t`.`region_id`,
  `t`.`status`,
  `t`.`create_date`,
  `t`.`logo_id`,
  `t`.`bg_id`,
  `t`.`file_id`,
  `t`.`type`,
  `t`.`name`,
  `t`.`latin_name`,
  `t`.`object_type`,
  `t`.`investment_sum`,
  `t`.`period`,
  `t`.`profit_norm`,
  `t`.`profit_clear`,
  `t`.`lat`,
  `t`.`lon`,
  `t`.`complete`,
  `t`.`industry_type`,
  `t`.`url`,
  `t`.`contact_partner`,
  `t`.`contact_address`,
  `t`.`contact_face`,
  `t`.`contact_role`,
  `t`.`contact_phone`,
  `t`.`contact_fax`,
  `t`.`contact_email`,
  `t`.`has_user_contact`,
  `t`.`has_user_company`,
  `t`.`is_disable`,
  `t`.`view_count`,
  `t`.`reply_count`,
  `t`.`is_imported`,
  `t`.`old_id`,
  `investment`.`id`,
  `investment`.`project_id`,
  `investment`.`finance`,
  `investment`.`short_description`,
  `investment`.`address`,
  `investment`.`market_size`,
  `investment`.`investment_form`,
  `investment`.`investment_direction`,
  `investment`.`financing_terms`,
  `investment`.`products`,
  `investment`.`max_products`,
  `investment`.`no_finRevenue`,
  `investment`.`no_finCleanRevenue`,
  `investment`.`profit`,
  `investment`.`company_legal`,
  `investment`.`company_description`,
  `investment`.`company_area`,
  `investment`.`company_name`,
  `investment`.`company_email`,
  `investment`.`company_phone`,
  `investment`.`company_inn`,
  `investment`.`company_ogrn`,
  `investment`.`project_price`,
  `investment`.`term_finance`,
  `investment`.`stage_project`,
  `investment`.`capital_dev`,
  `investment`.`equipment`,
  `investment`.`guarantee`,
  `investment`.`full_description`,
  `investment`.`finance_plan`,
  `investment`.`video_frame`,
  `investment`.`finance_plan_file_id`,
  `investment`.`prod_plan_file_id`,
  `investment`.`org_plan_file_id`,
  `innovative`.`id`,
  `innovative`.`project_id`,
  `innovative`.`project_description`,
  `innovative`.`project_history`,
  `innovative`.`project_address`,
  `innovative`.`project_step`,
  `innovative`.`market_size`,
  `innovative`.`financing_terms`,
  `innovative`.`product_description`,
  `innovative`.`relevance_type`,
  `innovative`.`profit`,
  `innovative`.`investment_goal`,
  `innovative`.`investment_type`,
  `innovative`.`finance_type`,
  `innovative`.`swot`,
  `innovative`.`strategy`,
  `innovative`.`exit_period`,
  `innovative`.`exit_price`,
  `innovative`.`exit_multi`,
  `innovative`.`project_price`,
  `innovative`.`invest_way`,
  `innovative`.`guarantee`,
  `innovative`.`structure`,
  `innovative`.`company_name`,
  `innovative`.`company_legal`,
  `innovative`.`company_info`,
  `innovative`.`company_area`,
  `investmentSite`.`id`,
  `investmentSite`.`project_id`,
  `investmentSite`.`owner`,
  `investmentSite`.`ownership`,
  `investmentSite`.`location_type`,
  `investmentSite`.`site_address`,
  `investmentSite`.`site_type`,
  `investmentSite`.`problem`,
  `investmentSite`.`distance_to_district`,
  `investmentSite`.`distance_to_road`,
  `investmentSite`.`distance_to_train_station`,
  `investmentSite`.`distance_to_air`,
  `investmentSite`.`closest_objects`,
  `investmentSite`.`has_fence`,
  `investmentSite`.`search_area`,
  `investmentSite`.`has_road`,
  `investmentSite`.`has_rail`,
  `investmentSite`.`has_port`,
  `investmentSite`.`has_mail`,
  `investmentSite`.`area`,
  `investmentSite`.`other`,
  `investmentSite`.`param_space`,
  `investmentSite`.`param_expansion`,
  `investmentSite`.`param_expansion_size`,
  `investmentSite`.`param_earth_category`,
  `investmentSite`.`param_relief`,
  `investmentSite`.`param_ground`,
  `businesses`.`id`,
  `businesses`.`project_id`,
  `businesses`.`leadership`,
  `businesses`.`founders`,
  `businesses`.`short_description`,
  `businesses`.`debts`,
  `businesses`.`has_bankruptcy`,
  `businesses`.`has_bail`,
  `businesses`.`other`,
  `businesses`.`industry_type`,
  `businesses`.`share`,
  `businesses`.`price`,
  `businesses`.`address`,
  `businesses`.`age`,
  `businesses`.`revenue`,
  `businesses`.`profit`,
  `businesses`.`role_type`,
  `businesses`.`legal_address`,
  `businesses`.`post_address`,
  `businesses`.`phone`,
  `businesses`.`fax`,
  `businesses`.`email`,
  `businesses`.`history`,
  `businesses`.`business_name`,
  `businesses`.`operational_cost`,
  `businesses`.`wage_fund`,
  `businesses`.`activity_sphere`
FROM `Project` `t`
  LEFT OUTER JOIN `InvestmentProject` `investment` ON (`investment`.`project_id` = `t`.`id`)
  LEFT OUTER JOIN `InnovativeProject` `innovative` ON (`innovative`.`project_id` = `t`.`id`)
  LEFT OUTER JOIN `InvestmentSite` `investmentSite` ON (`investmentSite`.`project_id` = `t`.`id`)
  LEFT OUTER JOIN `Business` `businesses` ON (`businesses`.`project_id` = `t`.`id`)
WHERE (
      (#common
        (#common
          ( #by TYPE
            (
              (
                (
                  (
                    t.type = 1
                  ) OR
                  (
                    (
                      t.type = 2
                    )
                    AND
                    (
                      (
                        innovative.project_price >= '0' AND innovative.project_price <= '1302'
                      )
                    )
                  )
                )
                OR
                (
                  t.type = 3
                )
              )
              OR
              (
                (
                  t.type = 4
                )
                AND
                (
                  (
                    investmentSite.param_space >= '2' AND investmentSite.param_space <= '29900'
                  )
                )
              )
            )
            OR
            (
              (
                (
                  t.type = 5
                )
                AND
                (
                  (
                    businesses.price >= '222' AND businesses.price <= '2000'
                  )
                )
              )
              AND
              (
                (
                  businesses.share >= '0' AND businesses.share <= '100'
                )
              )
            )
          )
          AND
          ( #common PARAMS
            (
              t.type IN (4, 5)
              OR
              (
                (
                  t.period >= '0' AND t.period <= '555'
                )
                AND
                (
                  t.profit_clear >= '0' AND t.profit_clear <= '500000000'
                )
                AND
                (
                  t.investment_sum >= '4163320788' AND t.investment_sum <= '4294967295'
                )
                AND
                (
                  t.profit_norm >= '0' AND t.profit_norm <= '123123'
                )
              )
            )
          )
        )
        AND
        (
          t.is_disable = 0 #common
        )
      )

  AND (t.status = "approved")) #common

:invest_site=4, :infra=3, :business = 5)