/**
 * BLOCK: second-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import "./editor.scss";
import "./style.scss";

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { InspectorControls } = wp.blockEditor;
import {
	FormToggle,
	Card,
	Flex,
	FlexBlock,
	TextControl,
	CardBody,
} from "@wordpress/components";
const { useState, Fragment } = wp.element;
import { useSelect } from "@wordpress/data";

// const {
// 	element: { useState },
// } = wp;

registerBlockType("cgb/block-hosting-block", {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __("hosting-info"), // Block title.
	icon: "shield", // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: "common", // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [__("hosting"), __("CGB Example"), __("create-guten-block")],

	attributes: {
		internalLink: {
			type: "string",
		},

		postType: {
			type: "string",
		},

		slug: {
			type: "string",
		},

		isInternalLinkVisible: {
			type: "boolean",
			default: false,
		},
		title: {
			type: "string",
		},
		anchor: {
			type: "string",
		},
	},

	edit: (props) => {
		function renderH2() {
			if (props.attributes.title.length !== 0) {
				return <h2>{props.attributes.title}</h2>;
			} else {
				return "";
			}
		}

		function setTitle(text) {
			props.setAttributes({
				title: text,
			});
		}
		function setAnchor(text) {
			props.setAttributes({
				anchor: text,
			});
		}
		function slugExtractor(link) {
			const slug = link.match(/(?<=(http:\/\/|https:\/\/).*\/)[^\/]*?(?=\/$)/g);
			const isHosting = /\/hosting\//.test(link);
			const postType = isHosting ? "hosting" : "post";
			const output = { slug: slug[0], postType };
			return output;
		}

		function setPostData(link) {
			if (link !== "") {
				const linkProps = slugExtractor(link);
				props.setAttributes({
					internalLink: link,
					postType: linkProps.postType,
					slug: linkProps.slug,
				});
			} else {
				props.setAttributes({
					internalLink: "",
					postType: "",
					slug: "",
				});
			}
		}
		function setChecked() {
			let currentState = props.attributes.isInternalLinkVisible;
			props.setAttributes({
				isInternalLinkVisible: !currentState,
			});
		}
		return (
			<div>
				{props.attributes.title ? <h2>{props.attributes.title}</h2> : null}
				<Card>
					<CardBody>
						<Flex>
							<FlexBlock>
								<TextControl
									label="Заголовок H2"
									value={props.attributes.title}
									onChange={(title) => setTitle(title)}
								/>
							</FlexBlock>
							<FlexBlock>
								<TextControl
									label="Якорь"
									value={props.attributes.anchor}
									onChange={(anchor) => setAnchor(anchor)}
								/>
							</FlexBlock>
						</Flex>
					</CardBody>
					<CardBody>
						<Flex>
							<FlexBlock>
								<TextControl
									label="Ссылка на страницу хостинга"
									value={props.attributes.internalLink}
									onChange={(link) => setPostData(link)}
								/>
							</FlexBlock>
							<FlexBlock>
								<p className="stg-small">А нужна ли нам ссылка на страницу?</p>
								<FormToggle
									checked={props.attributes.isInternalLinkVisible}
									onChange={setChecked}
								/>
							</FlexBlock>
						</Flex>
					</CardBody>
				</Card>
			</div>
		);
	},

	save: (props) => {
		return null;
	},
});
